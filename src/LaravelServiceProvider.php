<?php

namespace Orchestra\Canvas\Core;

use WpStarter\Contracts\Support\DeferrableProvider;
use WpStarter\Filesystem\Filesystem;
use WpStarter\Support\Composer;
use WpStarter\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('canvas.composer', static fn () => new Composer(new Filesystem));

        $this->app->singleton(PresetManager::class, static fn ($app) => new PresetManager($app));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, class-string>
     */
    public function provides(): array
    {
        return [
            PresetManager::class,
        ];
    }
}
