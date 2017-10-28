<?php

namespace RigorTalks;

/**
 * Class TemperatureNegativeException
 *
 * @package RigorTalks
 */
class TemperatureNegativeException extends \Exception
{
    public static function fromMeasure($measure)
    {
        return new static(
            sprintf("Measure %d should be positive", $measure)
        );
    }
}
