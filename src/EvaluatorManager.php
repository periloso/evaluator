<?php namespace Antonio88\Evaluator;

use Illuminate\Support\Manager;
use Antonio88\Evaluator\Adapter\File;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class EvaluatorManager extends Manager
{
    private $evaluator;
    private $expression;
    private $adapter;
    protected $app;

    /**
     * EvaluatorManager constructor.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(\Illuminate\Foundation\Application $app)
    {
        parent::__construct($app);
        $this->evaluator = $app->build(Evaluator::class);
        $this->expression = $app->build(ExpressionLanguage::class);
        $this->adapter = $app->build(File::class);
        $this->app = $app;
    }

    /**
     * Retrieve the default driver
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']->get('periloso/evaluator::driver', 'file');
    }

    /**
     * Set the default driver
     *
     * @param  string $name
     * @return  void
     */
    public function setDefaultDriver($name)
    {
        $this->app['config']->set('periloso/evaluator::driver', $name);
    }

    /**
     * Creates a caching driver.
     *
     * @param string $driver
     * @return Evaluator
     */
    public function createDriver($driver)
    {
        return new Evaluator($this->expression, $this->adapter);
    }
}
