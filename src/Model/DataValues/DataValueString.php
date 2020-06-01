<?php

namespace Model\DataValues;

class DataValueString extends DataValue
{
    protected $type = 'string';
    protected $string = '';

    /**
     * DataValueString constructor.
     * @param string $data
     */
    public function __construct($data)
    {
        $this->setString($data);
    }

    /**
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * @param string $string
     */
    public function setString($string)
    {
        $this->string = $string;
    }

    public function getValue()
    {
        return $this->string;
    }
}