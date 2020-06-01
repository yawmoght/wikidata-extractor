<?php

namespace Model\DataValues;

class DataValueTime extends DataValue
{
    protected $time;
    protected $timezone;
    protected $before;
    protected $after;
    protected $precision;
    protected $calendarModel;

    protected $type = 'time';

    /**
     * DataValueTime constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->setTime($data['time']);
        $this->setTimezone($data['timezone']);
        $this->setBefore($data['before']);
        $this->setAfter($data['after']);
        $this->setPrecision($data['precision']);
        $this->setCalendarModel($data['calendarmodel']);
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @param mixed $timezone
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return mixed
     */
    public function getBefore()
    {
        return $this->before;
    }

    /**
     * @param mixed $before
     */
    public function setBefore($before)
    {
        $this->before = $before;
    }

    /**
     * @return mixed
     */
    public function getAfter()
    {
        return $this->after;
    }

    /**
     * @param mixed $after
     */
    public function setAfter($after)
    {
        $this->after = $after;
    }

    /**
     * @return mixed
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * @param mixed $precision
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
    }

    /**
     * @return mixed
     */
    public function getCalendarModel()
    {
        return $this->calendarModel;
    }

    /**
     * @param mixed $calendarModel
     */
    public function setCalendarModel($calendarModel)
    {
        $this->calendarModel = $calendarModel;
    }

    public function getValue()
    {
        return array(
            'time' => $this->getTime(),
            'timezone' => $this->getTimezone(),
            'before' => $this->getBefore(),
            'after' => $this->getAfter(),
            'precision' => $this->getPrecision(),
            'calendarmodel' => $this->getCalendarModel()
        );
    }

}