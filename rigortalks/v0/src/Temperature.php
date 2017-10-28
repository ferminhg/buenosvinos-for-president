<?php

namespace RigorTalks;

class TemperatureNegativeException extends \Exception {}

class Temperature
{
    private $measure;

    private function __construct($measure)
    {
        $this->setMeasure($measure);
    }

    /**
     * Self-Encapsulation
     * @param $measure
     */
    private function setMeasure($measure)
    {
        $this->checkMeasureIsPositive($measure); //GuardClause
        $this->measure = $measure;
    }

    /**
     * @param $measure
     * @throws TemperatureNegativeException
     */
    public function checkMeasureIsPositive($measure)
    {
        if ($measure < 0) {
            throw new TemperatureNegativeException("Measure should be positive");
        }
    }

    public static function take($measure)
    {
        return new Temperature($measure);
    }

    public function measure()
    {
        return $this->measure;
    }
}