<?php

namespace RigorTalks\Tests;

use RigorTalks\Temperature;
use RigorTalks\TemperatureTestClass;

/**
 * Class TemperatureTest
 */
class TemperatureTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function tryToCreateAValidTemperatureWithNameContructor()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            Temperature::take($measure)->measure()
        );
    }

    /**
     * @test
     * @expectedException \RigorTalks\TemperatureNegativeException
     */
    public function tryToCreateANonValidTemperature()
    {
        Temperature::take(-1);
    }

    /**
     * @test
     */
    public function tryToCreateAValidTemperature()
    {
        $measure = 18;
        $this->assertSame(
            $measure,
            Temperature::take($measure)->measure()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfAColdTemperatureIsSuperHot()
    {
        $this->assertFalse(
            TemperatureTestClass::take(10)->isSuperHot()
        );
    }

    /**
     * @test
     */
    public function tryToCheckIfASuperHotTemperatureIsSuperHot()
    {
        $this->assertTrue(
            TemperatureTestClass::take(100)->isSuperHot()
        );
    }
}