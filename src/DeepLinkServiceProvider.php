<?php

namespace DeepLink\Common;

use Illuminate\Support\ServiceProvider;

/**
 * Class DeepLinkServiceProvider
 * @package DeepLink\Common
 */
class DeepLinkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        if (class_exists('CreateDevicesTable')) {
            return;
        } else {
            $stub = __DIR__ . '/migrations/';
            $target = database_path('migrations') . '/';
            $this->publishes([$stub.'create_devices_table.php' => $target . date('Y_m_d_His', time()) . '_create_devices_table.php']);
        }

        $config_stub = __DIR__ . '/config/';
        $config_target = base_path('config') . '/';
        $this->publishes([$config_stub . 'deeplink.php' => $config_target . 'deeplink.php']);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/deeplink.php', 'deeplink');
    }
}
