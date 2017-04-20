<?php namespace Periloso\Evaluator\Adapter;

use Illuminate\Support\Fluent;
use Illuminate\Support\Arr as A;
use Illuminate\Cache\Repository as CacheRepository;
use Periloso\Evaluator\Contracts\AdapterInterface;
use Periloso\Evaluator\Traits\ExpressionCheckerTrait;
use Periloso\Evaluator\Exceptions\MissingExpressionException;

class File implements AdapterInterface
{
    use ExpressionCheckerTrait;

    /**
     * Cache repository
     *
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * Create new file adapter instance
     *
     * @param CacheRepository|\Illuminate\Contracts\Cache\Repository $cache
     */
    public function __construct(CacheRepository $cache)
    {
        $this->cache = $cache;
    }

    /**
     * {@inheritdoc}
     */
    public function load()
    {
        $this->expressions = $this->cache->get('periloso.evaluator', []);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reload()
    {
        $this->cache->forever('periloso.evaluator', $this->expressions());
    }

    /**
     * {@inheritdoc}
     */
    public function add($key, $expressions)
    {
        if ( ! is_array($expressions)) {
            $this->expressions = A::add($this->expressions, $key, $expressions);

            return $this;
        }

        $expression = new Fluent($expressions);

        if ($this->verifyExpression($expression)) {
            $this->expressions = A::add($this->expressions, $key, $expression);
        }

        $this->reload();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        $expression = A::get($this->expressions, $key, null);

        if (is_null($expression)) {
            throw new MissingExpressionException("Expression {{$key}} is not defined");
        }

        return $expression;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key)
    {
        A::forget($this->expressions, $key);

        $this->reload();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function expressions()
    {
        return $this->expressions;
    }
}