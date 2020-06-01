<?php

namespace Model\DataValues;

use Model\DataValue;

class DataValueCoordinate extends DataValue
{
    protected $latitude;
    protected $longitude;
    protected $altitude;
    protected $precision;
    protected $globe;

    protected $type = 'globecoordinate';

    /**
     * DataValueCoordinate constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->setLatitude($data['latitude']);
        $this->setLongitude($data['longitude']);
        $this->setAltitude($data['altitude']);
        $this->setPrecision($data['precision']);
        $this->setGlobe($data['globe']);
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return mixed
     */
    public function getAltitude()
    {
        return $this->altitude;
    }

    /**
     * @return mixed
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * @return mixed
     */
    public function getGlobe()
    {
        return $this->globe;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @param mixed $altitude
     */
    public function setAltitude($altitude)
    {
        $this->altitude = $altitude;
    }

    /**
     * @param mixed $precision
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
    }

    /**
     * @param mixed $globe
     */
    public function setGlobe($globe)
    {
        $this->globe = $globe;
    }

    public function getValue()
    {
        return array(
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
            'altitude' => $this->getAltitude(),
            'precision' => $this->getPrecision(),
            'globe' => $this->getGlobe()
        );
    }

}