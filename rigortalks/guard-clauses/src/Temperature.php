<?php

namespace RigorTalks;

class TemperatureNegativeException extends \Exception {}

class Temperature
{
    private $measure;

    public function __construct($measure)
    {
        if ($measure >= 0) {
            $this->measure = $measure;
        } else {
            throw new TemperatureNegativeException("Measure should be positive");
        }
    }

    public function measure()
    {
        return $this->measure;
    }
}