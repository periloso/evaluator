<?php namespace Antonio88\Evaluator\Traits;

use Illuminate\Support\Fluent;
use Antonio88\Evaluator\Exceptions\MissingKeyException;

trait ExpressionCheckerTrait
{
    /**
     * Available expressions
     *
     * @var array
     */
    protected $expressions = [];

    /**
     * Reserved keys for an expression
     *
     * @var array
     */
    protected $reservedKeys = ['target', 'action'];

    /**
     * Validate if expression contains the reserve keys
     *
     * @param  Fluent $expression
     * @return boolean
     * @throws  \Periloso\Evaluator\Exceptions\MissingKeyException
     */
    protected function verifyExpression(Fluent $expression)
    {
        foreach ($this->reservedKeys as $key) {
            if (is_null($expression->get($key))) {
                throw new MissingKeyException("Expression is missing {$key}");
            }
        }

        return true;
    }
}
