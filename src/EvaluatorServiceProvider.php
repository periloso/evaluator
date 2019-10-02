<?php namespace Antonio88\Evaluator;

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
        $this->app->singleton('antonio88.evaluator', function ($app) {
            return new EvaluatorManager($app);
        });

        $this->app->bind('Antonio88\Evaluator\Contracts\AdapterInterface', 'Antonio88\Evaluator\Adapter\File');

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
        $loader->alias('Evaluator', 'Antonio88\Evaluator\Facades\Evaluator');
    }
}
