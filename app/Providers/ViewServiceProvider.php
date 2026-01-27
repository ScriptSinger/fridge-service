<?php

namespace App\Providers;

use App\Models\Device;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register devices.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap devices.
     */
    public function boot(): void
    {
        // Передаем devices в футер с кешированием
        View::composer('components.footer.devices', function ($view) {
            // Ключ кеша
            $cacheKey = 'footer_devices';

            // Берем из кеша или выполняем запрос и сохраняем результат
            $devices = Cache::remember($cacheKey, 3600, function () {
                return Device::all();
            });

            $view->with('devices', $devices);
        });

        // Сброс кеша при сохранении или удалении Service
        Device::saved(function () {
            Cache::forget('footer_devices');
        });

        Device::deleted(function () {
            Cache::forget('footer_devices');
        });
    }
}
