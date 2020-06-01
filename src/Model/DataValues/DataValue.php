<?php

namespace Model\DataValues;

use Model\DataModel;

abstract class DataValue extends DataModel
{
    protected $type;

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public abstract function getValue();

    public function jsonSerialize()
    {
        return array(
            'type' => $this->getType(),
            'value' => $this->getValue(),
        );
    }

}