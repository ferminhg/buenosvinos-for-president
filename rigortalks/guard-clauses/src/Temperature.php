<?php

namespace RigorTalks;

class TemperatureNegativeException extends \Exception {}

class Temperature
{
    private $measure;

    public function __construct($measure)
    {
        $this->setMeasure($measure);
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

    public function measure()
    {
        return $this->measure;
    }

    /**
     * Self-Encapsulation
     * @param $measure
     */
    private function setMeasure($measure)
    {
        //GuardClause
        $this->checkMeasureIsPositive($measure);
        $this->measure = $measure;
    }
}