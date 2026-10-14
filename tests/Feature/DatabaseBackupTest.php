<?php

namespace Tests\Feature;

use Illuminate\Process\PendingProcess;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DatabaseBackupTest extends TestCase
{
    private string $directory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->directory = storage_path('framework/testing/backups');
        File::deleteDirectory($this->directory);

        config([
            'backup.path' => $this->directory,
            'backup.keep_days' => 7,
            'backup.cloud_keep_days' => 30,
            'filesystems.disks.backups.bucket' => 'repair-center-backups',
            'database.default' => 'mysql',
            'database.connections.mysql' => [
                'driver' => 'mysql',
                'host' => 'mysql',
                'port' => 3306,
                'database' => 'repair',
                'username' => 'user',
                'password' => 'secret pass',
            ],
        ]);

        Storage::fake('backups');
    }

    protected function tearDown(): void
    {
        File::deleteDirectory($this->directory);

        parent::tearDown();
    }

    public function test_backup_is_dumped_with_password_in_environment_verified_and_uploaded(): void
    {
        Process::fake(fn (PendingProcess $process) => $this->writeDumpFile($process));
        $this->travelTo('2026-10-15 02:30:00');

        $this->artisan('db:backup', ['--label' => 'Перед импортом'])
            ->expectsOutputToContain('Копия снята и проверена')
            ->expectsOutputToContain('Загружена в облако: db/repair-2026-10-15_023000-pered-importom.sql.gz')
            ->assertSuccessful();

        Process::assertRan(fn (PendingProcess $process): bool => str_contains($process->command[2], 'mysqldump')
            && str_contains($process->command[2], '--single-transaction')
            && $process->environment['MYSQL_PWD'] === 'secret pass'
            && ! str_contains($process->command[2], 'secret pass'));

        $local = $this->directory.'/repair-2026-10-15_023000-pered-importom.sql.gz';
        Storage::disk('backups')->assertExists('db/repair-2026-10-15_023000-pered-importom.sql.gz');
        $this->assertSame(File::get($local), Storage::disk('backups')->get('db/repair-2026-10-15_023000-pered-importom.sql.gz'));
    }

    public function test_failed_dump_is_removed_and_nothing_is_uploaded(): void
    {
        Process::fake(function (PendingProcess $process) {
            $this->writeDumpFile($process);

            return Process::result(errorOutput: 'Access denied', exitCode: 2);
        });

        $this->artisan('db:backup')
            ->expectsOutputToContain('Дамп не снят: Access denied')
            ->assertFailed();

        $this->assertSame([], File::glob($this->directory.'/*.sql.gz'));
        $this->assertSame([], Storage::disk('backups')->allFiles());
    }

    public function test_missing_bucket_fails_but_keeps_local_copy(): void
    {
        config(['filesystems.disks.backups.bucket' => null]);
        Process::fake(fn (PendingProcess $process) => $this->writeDumpFile($process));

        $this->artisan('db:backup')
            ->expectsOutputToContain('Не задан бакет для копий')
            ->assertFailed();

        $this->assertCount(1, File::glob($this->directory.'/*.sql.gz'));
    }

    public function test_old_copies_are_pruned_locally_and_in_cloud_but_newest_kept(): void
    {
        Process::fake(fn (PendingProcess $process) => $this->writeDumpFile($process));
        $cloud = Storage::disk('backups');

        File::ensureDirectoryExists($this->directory);
        File::put($this->directory.'/old.sql.gz', 'x');
        touch($this->directory.'/old.sql.gz', now()->subDays(10)->getTimestamp());
        File::put($this->directory.'/recent.sql.gz', 'x');
        touch($this->directory.'/recent.sql.gz', now()->subDays(2)->getTimestamp());

        $cloud->put('db/old.sql.gz', 'x');
        touch($cloud->path('db/old.sql.gz'), now()->subDays(40)->getTimestamp());
        $cloud->put('db/recent.sql.gz', 'x');
        touch($cloud->path('db/recent.sql.gz'), now()->subDays(20)->getTimestamp());

        $this->artisan('db:backup')->assertSuccessful();

        $this->assertFileDoesNotExist($this->directory.'/old.sql.gz');
        $this->assertFileExists($this->directory.'/recent.sql.gz');
        $cloud->assertMissing('db/old.sql.gz');
        $cloud->assertExists('db/recent.sql.gz');
    }

    /**
     * Fake mysqldump: writes a gzipped dump ending with the completion marker,
     * and lets the integrity check run for real against it.
     */
    private function writeDumpFile(PendingProcess $process)
    {
        $file = $process->environment['BACKUP_FILE'] ?? null;

        if (str_contains($process->command[2], 'mysqldump')) {
            File::put($file, gzencode("CREATE TABLE t (id int);\n-- Dump completed on 2026-10-15 02:30:00\n"));

            return Process::result();
        }

        $content = gzdecode(File::get($file));

        return Process::result(exitCode: str_ends_with(trim($content), 'Dump completed on 2026-10-15 02:30:00') ? 0 : 1);
    }
}
