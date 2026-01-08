<?php

namespace App\Providers;


use App\Models\Service;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Передаем services в футер с кешированием
        View::composer('components.footer.services', function ($view) {
            // Ключ кеша
            $cacheKey = 'footer_services';

            // Берем из кеша или выполняем запрос и сохраняем результат
            $services = Cache::remember($cacheKey, 3600, function () {
                return Service::all();
            });

            $view->with('services', $services);
        });

        // Сброс кеша при сохранении или удалении Service
        Service::saved(function () {
            Cache::forget('footer_services');
        });

        Service::deleted(function () {
            Cache::forget('footer_services');
        });
    }
}
