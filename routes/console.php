<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('sitemap:generate')->dailyAt('03:15');

// Ночная резервная копия базы: проверка, загрузка в облако, ротация (config/backup.php)
Schedule::command('db:backup')->dailyAt('02:30')->timezone('Asia/Yekaterinburg')->withoutOverlapping()
    ->onFailure(fn () => Log::critical('Ночная резервная копия базы не снята или не загружена в облако — см. вывод db:backup.'));
