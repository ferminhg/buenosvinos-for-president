<?php

namespace RigorTalks\Tests;

use RigorTalks\ColdThresholdSource;
use RigorTalks\Temperature;
use RigorTalks\TemperatureTestClass;

/**
 * Class TemperatureTest
 */
class TemperatureTest extends \PHPUnit_Framework_TestCase implements ColdThresholdSource
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

    /**
     * @test
     */
    public function tryToCheckIfASuperColdTemperatureIsSuperCold()
    {
        $this->assertTrue(
            Temperature::take(10)->isSuperCold(
                $this
            )
        );
    }

    public function getThreshold()
    {
        return 50;
    }

    /**
     * @test
     */
    public function tryToCreateATemperatureFromStation()
    {
        $this->assertSame(
            50,
            Temperature::fromStation(
                $this
            )->measure()
        );
    }

    public function sensor()
    {
        return $this;

    }

    public function temperature()
    {
        return $this;
    }

    public function measure()
    {
        return 50;

    }
}