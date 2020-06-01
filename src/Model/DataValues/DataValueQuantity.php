<?php

namespace Model\DataValues;

class DataValueQuantity extends DataValue
{
    protected $amount;
    protected $upperBound;
    protected $lowerBound;
    protected $unit;

    protected $type = 'quantity';

    /**
     * DataValueQuantity constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->setAmount($data['amount']);
        $this->setUpperBound($data['upperBound']);
        $this->setLowerBound($data['lowerBound']);
        $this->setUnit($data['unit']);
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getUpperBound()
    {
        return $this->upperBound;
    }

    /**
     * @param mixed $upperBound
     */
    public function setUpperBound($upperBound)
    {
        $this->upperBound = $upperBound;
    }

    /**
     * @return mixed
     */
    public function getLowerBound()
    {
        return $this->lowerBound;
    }

    /**
     * @param mixed $lowerBound
     */
    public function setLowerBound($lowerBound)
    {
        $this->lowerBound = $lowerBound;
    }

    /**
     * @return mixed
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param mixed $unit
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
    }

    public function getValue()
    {
        return array(
            'amount' => $this->getAmount(),
            'upperBound' => $this->getUpperBound(),
            'lowerBound' => $this->getLowerBound(),
            'unit' => $this->getUnit(),
        );
    }

}