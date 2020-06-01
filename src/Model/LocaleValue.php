<?php

namespace Model;

class LocaleValue extends DataModel
{
    protected $language;
    protected $value;

    /**
     * LocaleValue constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->setValue($data['value']);
        $this->setLanguage($data['language']);
    }

    /**
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param mixed $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function jsonSerialize()
    {
        return array(
            'value' => $this->getValue(),
            'language' => $this->getLanguage(),
        );
    }

}