<?php namespace Antonio88\Evaluator;

use Illuminate\Support\Collection as BaseCollection;

class Collection extends BaseCollection
{
    /**
     * Original value before calculation
     *
     * @var string|integer
     */
    protected $originalValue;

    /**
     * Calculated value after condition
     *
     * @var string|integer
     */
    protected $calculatedValue;

    /**
     * Set the original value
     *
     * @param $value
     * @return \Periloso\Evaluator\Collection
     */
    public function setOriginalValue($value)
    {
        $this->originalValue = $value;

        return $this;
    }

    /**
     * Set the calculated value
     *
     * @param string|integer $value
     * @return \Periloso\Evaluator\Collection
     */
    public function setCalculatedValue($value)
    {
        $this->calculatedValue = $value;

        return $this;
    }

    /**
     * Retrieve the original value
     *
     * @return string|integer
     */
    public function getOriginal()
    {
        return $this->originalValue;
    }

    /**
     * Retrieve the calculated value
     *
     * @return string|integer
     */
    public function getResult()
    {
        return $this->calculatedValue;
    }
}
