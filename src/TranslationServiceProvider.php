<?php

namespace DarthSoup\TranslationExtended;

use DarthSoup\TranslationExtended\Loader\FileLoader;
use DarthSoup\TranslationExtended\Loader\JsonLoader;
use Illuminate\Translation\TranslationServiceProvider as BaseTranslationServiceProvider;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends BaseTranslationServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/translations.php' => config_path('translations.php'),
        ], 'config');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/translations.php', 'translations');

        $this->registerLoader();

        $this->registerTranslator();
    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function ($app) {
            $config = $app->make('config')->get('translations');

            return new FileLoader($app['files'], $config['translations_path']);
        });
    }

    /**
     * Register the translation line loader.
     *
     * @return void
     */
    protected function registerTranslator()
    {
        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];

            // When registering the translator component, we'll need to set the default
            // locale as well as the fallback locale. So, we'll grab the application
            // configuration so we can easily get both of these values from there.
            $locale = $app['config']['app.locale'];

            $trans = new Translator($loader, $locale);

            $trans->setFallback($app['config']['app.fallback_locale']);

            return $trans;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'translator',
            'translation.loader'
        ];
    }
}
