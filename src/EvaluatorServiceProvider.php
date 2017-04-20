<?php namespace Periloso\Evaluator;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class EvaluatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap available services
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register available services
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('periloso.evaluator', function ($app) {
            return new EvaluatorManager($app);
        });

        $this->app->bind('Periloso\Evaluator\Contracts\AdapterInterface', 'Periloso\Evaluator\Adapter\File');

        $this->registerFacade();
    }

    /**
     * Register facade
     *
     * @return void
     */
    protected function registerFacade()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('Evaluator', 'Periloso\Evaluator\Facades\Evaluator');
    }
}
