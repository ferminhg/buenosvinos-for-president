<?php

namespace RigorTalks;


class Temperature
{
    private $measure;

    /**
     * @param $measure
     * @return Temperature
     */
    public static function take($measure)
    {
        return new static($measure);
    }

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
        if ($measure <= 0) {
            throw TemperatureNegativeException::fromMeasure($measure);
        }
    }

    public function measure()
    {
        return $this->measure;
    }

    public function isSuperHot()
    {
        $threshold = $this->getThreshold();

        return $this->measure() > $threshold;
    }

    /**
     *  Metodo que implementa infraestructura
     * @return mixed
     */
    protected function getThreshold()
    {
        $conn = \Doctrine\DBAL\DriverManager::getConnection(array(
            'dbname' => 'test',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql'
        ), new \Doctrine\DBAL\Configuration());

        $threshold = $conn->fetchColumn('select hot_threshold From configuration');
        return $threshold;
    }

    public function isSuperCold(ColdThresholdSource $coldThresholdSource)
    {
        $threshold = $coldThresholdSource->getThreshold();

        return $this->measure() < $threshold;
    }

    public static function fromStation($station)
    {
        return new static(
            $station->sensor()->temperature()->measure()
        );
    }

    public function add(self $anotherTemperature)
    {
        return new self(
            $this->measure()
            + $anotherTemperature->measure()
        );
    }
}