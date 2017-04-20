<?php namespace Periloso\Evaluator\Contracts;

interface AdapterInterface
{
    /**
     * Load expressions from cache
     *
     * @return \Periloso\Evaluator\Contracts\AdapterInterface
     */
    public function load();

    /**
     * Reload the expression cache
     *
     * @return void
     */
    public function reload();

    /**
     * Add a new expression for evaluation
     *
     * @param string $key
     * @param array|string  $expression
     * @return \Periloso\Evaluator\Contracts\AdapterInterface
     */
    public function add($key, $expression);

    /**
     * Retrieve an expression
     *
     * @param  string $key
     * @return mixed
     * @throws  \Periloso\Evaluator\Exceptions\MissingExpressionException
     */
    public function get($key);

    /**
     * Remove an expression
     *
     * @param  string $key
     * @return \Periloso\Evaluator\Contracts\AdapterInterface
     */
    public function remove($key);

    /**
     * Retrieve all available expressions
     *
     * @return array
     */
    public function expressions();
}
