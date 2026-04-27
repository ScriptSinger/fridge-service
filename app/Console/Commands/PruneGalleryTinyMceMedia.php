<?php

namespace App\Console\Commands;

use App\Models\Gallery;
use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PruneGalleryTinyMceMedia extends Command
{
    protected $signature = 'media:prune-gallery-tinymce
        {--disk= : Storage disk to use (defaults to filesystems.media)}
        {--prefix= : Folder prefix to scan (defaults to config)}
        {--older-than= : Delete only files older than N days (defaults to config)}
        {--delete : Actually delete files (default: dry-run)}';

    protected $description = 'Prune orphaned TinyMCE uploads from gallery descriptions (dry-run by default)';

    public function handle(): int
    {
        $diskOption = $this->option('disk');
        $disk = (string) (
            ($diskOption !== null && $diskOption !== '' ? $diskOption : null)
            ?: config('media_cleanup.gallery_tinymce.disk')
            ?: config('filesystems.media')
        );

        $prefixOption = $this->option('prefix');
        $prefix = (string) (
            ($prefixOption !== null && $prefixOption !== '' ? $prefixOption : null)
            ?: config('media_cleanup.gallery_tinymce.prefix', 'galleries/content')
        );
        $prefix = trim($prefix, '/');

        // Note: "0" is a valid value but is falsy in PHP, so avoid ?: here.
        $olderThanOption = $this->option('older-than');
        $olderThanDays = (int) (
            ($olderThanOption !== null && $olderThanOption !== '' ? $olderThanOption : null)
            ?? config('media_cleanup.gallery_tinymce.older_than_days', 30)
        );
        $olderThanTimestamp = now()->subDays(max(0, $olderThanDays))->timestamp;

        $doDelete = (bool) $this->option('delete');

        $this->info("Disk: {$disk}");
        $this->info("Prefix: {$prefix}");
        $this->info("Mode: " . ($doDelete ? 'DELETE' : 'DRY-RUN'));
        $this->info("Older than: {$olderThanDays} days");

        $referenced = $this->collectReferencedPaths($prefix);
        $this->line('Referenced files found in DB: ' . count($referenced));

        $storage = Storage::disk($disk);
        $allFiles = $storage->allFiles($prefix);
        $this->line('Files in storage: ' . count($allFiles));

        $candidates = [];
        $deleted = 0;

        foreach ($allFiles as $path) {
            $path = ltrim((string) $path, '/');

            if (isset($referenced[$path])) {
                continue;
            }

            try {
                $lastModified = (int) $storage->lastModified($path);
            } catch (\Throwable $e) {
                $this->warn("Skip (no lastModified): {$path}");
                continue;
            }

            if ($lastModified > $olderThanTimestamp) {
                continue;
            }

            if ($doDelete) {
                try {
                    if ($storage->delete($path)) {
                        $deleted++;
                    } else {
                        $this->warn("Failed to delete: {$path}");
                    }
                } catch (\Throwable $e) {
                    $this->warn("Failed to delete: {$path}");
                }
            } else {
                $candidates[] = $path;
            }
        }

        if ($doDelete) {
            $this->info("Deleted: {$deleted}");
        } else {
            $this->info('Would delete: ' . count($candidates));
            foreach (array_slice($candidates, 0, 30) as $path) {
                $this->line("- {$path}");
            }
            if (count($candidates) > 30) {
                $this->line('... (use --delete to apply)');
            }
        }

        return self::SUCCESS;
    }

    /**
     * @return array<string, true> Set of referenced storage paths.
     */
    private function collectReferencedPaths(string $prefix): array
    {
        $referenced = [];

        Gallery::query()
            ->select(['id', 'description'])
            ->whereNotNull('description')
            ->where('description', '!=', '')
            ->chunkById(200, function ($chunk) use (&$referenced, $prefix) {
                foreach ($chunk as $gallery) {
                    $html = (string) ($gallery->description ?? '');
                    foreach ($this->extractPathsFromHtml($html, $prefix) as $path) {
                        $referenced[$path] = true;
                    }
                }
            });

        return $referenced;
    }

    /**
     * @return list<string>
     */
    private function extractPathsFromHtml(string $html, string $prefix): array
    {
        $paths = [];

        foreach ($this->extractImgSrc($html) as $src) {
            $path = $this->normalizeToStoragePath($src, $prefix);
            if ($path !== null) {
                $paths[] = $path;
            }
        }

        return array_values(array_unique($paths));
    }

    /**
     * @return list<string>
     */
    private function extractImgSrc(string $html): array
    {
        $html = trim($html);
        if ($html === '') {
            return [];
        }

        // Prefer DOM parsing; fall back to a simple regex if HTML is malformed.
        $srcs = [];

        try {
            $dom = new DOMDocument();
            $previous = libxml_use_internal_errors(true);
            $dom->loadHTML(
                '<!doctype html><html><head><meta charset="utf-8"></head><body>' . $html . '</body></html>'
            );
            libxml_clear_errors();
            libxml_use_internal_errors($previous);

            foreach ($dom->getElementsByTagName('img') as $img) {
                $src = (string) $img->getAttribute('src');
                if ($src !== '') {
                    $srcs[] = $src;
                }
            }
        } catch (\Throwable $e) {
            // Ignore and use regex fallback.
        }

        if ($srcs !== []) {
            return $srcs;
        }

        if (preg_match_all('/<img\\b[^>]*\\bsrc=[\"\']([^\"\']+)[\"\']/i', $html, $m)) {
            return array_values(array_filter($m[1] ?? [], fn ($v) => is_string($v) && $v !== ''));
        }

        return [];
    }

    private function normalizeToStoragePath(string $src, string $prefix): ?string
    {
        $src = trim($src);
        if ($src === '' || str_starts_with($src, 'data:')) {
            return null;
        }

        // Drop query/hash.
        $src = preg_split('/[?#]/', $src, 2)[0] ?? $src;

        // If src is URL-encoded, decode the path portion.
        $src = urldecode($src);

        $needle = $prefix . '/';
        $pos = strpos($src, $needle);
        if ($pos === false) {
            // Also allow exact prefix match (rare).
            if (str_contains($src, $prefix)) {
                $pos = strpos($src, $prefix);
                if ($pos === false) {
                    return null;
                }
                $path = substr($src, $pos);
            } else {
                return null;
            }
        } else {
            $path = substr($src, $pos);
        }

        $path = ltrim((string) $path, '/');
        if (!str_starts_with($path, $prefix . '/')) {
            return null;
        }

        return $path;
    }
}
