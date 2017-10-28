<?php

namespace RigorTalks\Tests;

use RigorTalks\Temperature;

/**
 * Class TemperatureTest
 */
class TemperatureTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException RigorTalks\TemperatureNegativeException
     */
    public function tryToCreateANonValidTemperature()
    {
        new Temperature(-1);
    }


    /**
     * @test
     */
    public function tryToCreateAValidTemperature()
    {
        $measure = 18;
        $this->assertSame(
          $measure,
            (new Temperature($measure))->measure()
        );
    }

}