<?php

namespace RigorTalks;

class TemperatureNegativeException extends \Exception
{
    public static function fromMeasure($measure)
    {
        return new static(
            sprintf("Measure %d should be positive", $measure)
        );
    }
}

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
            throw TemperatureNegativeException::fromMeasure($measure);
        }
    }

    /**
     * @param $measure
     * @return Temperature
     */
    public static function take($measure)
    {
        return new static($measure);
    }

    public function measure()
    {
        return $this->measure;
    }
}