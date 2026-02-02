<?php

declare(strict_types=1);

namespace Brunocfalcao\UiSkeleton;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class UiSkeletonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/ui-skeleton.php',
            'ui-skeleton'
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
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ui');

        // Register Blade components with the configured prefix
        $prefix = config('ui-skeleton.prefix', 'ui');

        Blade::componentNamespace('Brunocfalcao\\UiSkeleton\\Views\\Components', $prefix);
    }

    protected function registerBladeDirectives(): void
    {
        Blade::directive('uiSkeletonStyles', function () {
            return "<?php echo view('ui::partials.styles')->render(); ?>";
        });

        Blade::directive('uiSkeletonScripts', function () {
            return "<?php echo view('ui::partials.scripts')->render(); ?>";
        });
    }

    protected function registerPublishing(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        // Publish config
        $this->publishes([
            __DIR__.'/../config/ui-skeleton.php' => config_path('ui-skeleton.php'),
        ], 'ui-skeleton-config');

        // Publish views (for customization)
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/ui-skeleton'),
        ], 'ui-skeleton-views');

        // Publish assets (CSS and JS)
        $this->publishes([
            __DIR__.'/../resources/css' => resource_path('css/vendor/ui-skeleton'),
            __DIR__.'/../resources/js' => resource_path('js/vendor/ui-skeleton'),
        ], 'ui-skeleton-assets');
    }
}
