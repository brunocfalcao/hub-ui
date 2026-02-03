<?php

declare(strict_types=1);

namespace HubUI;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HubUIServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/hub-ui.php',
            'hub-ui'
        );
    }

    public function boot(): void
    {
        $this->registerViews();
        $this->registerBladeDirectives();
        $this->registerPublishing();
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hub-ui');

        // Register anonymous Blade components
        // Components at resources/views/components/* are available as <x-hub-ui::*>
        Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', 'hub-ui');
    }

    protected function registerBladeDirectives(): void
    {
        Blade::directive('hubUiStyles', function () {
            return "<?php echo view('hub-ui::partials.styles')->render(); ?>";
        });

        Blade::directive('hubUiScripts', function () {
            return "<?php echo view('hub-ui::partials.scripts')->render(); ?>";
        });
    }

    protected function registerPublishing(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        // Publish config
        $this->publishes([
            __DIR__.'/../config/hub-ui.php' => config_path('hub-ui.php'),
        ], 'hub-ui-config');

        // Publish views (for customization)
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/hub-ui'),
        ], 'hub-ui-views');

        // Publish assets (CSS and JS)
        $this->publishes([
            __DIR__.'/../resources/css' => resource_path('css/vendor/hub-ui'),
            __DIR__.'/../resources/js' => resource_path('js/vendor/hub-ui'),
        ], 'hub-ui-assets');
    }
}
