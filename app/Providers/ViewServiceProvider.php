<?php

namespace App\Providers;

use App\Models\Device;
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
        View::composer('components.ui.nav', function ($view) {
            $view->with([
                'navItems'    => $this->navItems(),
                'repairItems' => $this->repairItems(),
            ]);
        });

        View::composer('components.footer.devices', function ($view) {
            $view->with('devices', $this->devices());
        });

        Device::saved(fn() => $this->clearCache());
        Device::deleted(fn() => $this->clearCache());
    }

    private function navItems()
    {
        return collect(config('navigation'))
            ->map(fn($item) => [
                'label' => $item['label'],
                'href'  => route($item['route']),
            ]);
    }

    private function devices()
    {
        return Cache::remember('devices_active', 3600, function () {
            return Device::query()
                ->where('is_active', true)
                ->orderBy('type')
                ->get();
        });
    }

    private function repairItems()
    {
        return $this->devices()
            ->map(fn(Device $device) => [
                'label' => $device->typeInCase('genitive'),
                'href'  => route('devices.show', $device),
            ]);
    }

    private function clearCache(): void
    {
        Cache::forget('devices_active');
    }
}
