<?php

namespace Model;

class Snak extends DataModel
{
    protected $snaktype;
    protected $property;
    protected $datatype;
    protected $datavalue;
    protected $qualifiers = array();

    /**
     * Snak constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->snaktype = $data['snaktype'];
        $this->property = $data['property'];
        $this->datatype = $data['datatype'];
        $this->datavalue = isset($data['datavalue']) ? $data['datavalue'] : null;
    }

    /**
     * @return mixed
     */
    public function getSnaktype()
    {
        return $this->snaktype;
    }

    /**
     * @param mixed $snaktype
     */
    public function setSnaktype($snaktype)
    {
        $this->snaktype = $snaktype;
    }

    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param mixed $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return mixed
     */
    public function getDatatype()
    {
        return $this->datatype;
    }

    /**
     * @param mixed $datatype
     */
    public function setDatatype($datatype)
    {
        $this->datatype = $datatype;
    }

    /**
     * @return mixed
     */
    public function getDatavalue()
    {
        return $this->datavalue;
    }

    /**
     * @param mixed $datavalue
     */
    public function setDatavalue($datavalue)
    {
        $this->datavalue = $datavalue;
    }

    /**
     * @return array
     */
    public function getQualifiers()
    {
        return $this->qualifiers;
    }

    /**
     * @param array $qualifiers
     */
    public function setQualifiers($qualifiers)
    {
        $this->qualifiers = $qualifiers;
    }

    public function addQualifier($qualifier)
    {
        $this->qualifiers[] = $qualifier;
    }

    public function jsonSerialize()
    {
        return array(
            'snaktype' => $this->getSnaktype(),
            'property' => $this->getProperty(),
            'datatype' => $this->getDatatype(),
            'datavalue' => $this->getDatavalue(),
            'qualifiers' => $this->getQualifiers(),
        );
    }

}