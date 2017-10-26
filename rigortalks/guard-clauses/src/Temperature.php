<?php

namespace RigorTalks;

class TemperatureNegativeException extends \Exception {}

class Temperature
{
    private $measure;

    public function __construct($measure)
    {
        /*
         * GuardClauses. No aseguramos que se ejecuta esta guarda antes de hacer nada
         */
        $this->checkMeasureIsPositive($measure);
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

    public function measure()
    {
        return $this->measure;
    }
}