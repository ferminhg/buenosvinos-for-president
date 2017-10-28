<?php

namespace RigorTalks;

/**
 * Usamos esta clase para poder realizar test sobre nuestra logica de negocio
 * Sobreescribiendo los metodos de infraestructura
 * Class TemperatureTestClass
 *
 * @package RigorTalks
 */
class TemperatureTestClass extends Temperature
{
    protected function getThreshold()
    {
        return 50;
    }
}