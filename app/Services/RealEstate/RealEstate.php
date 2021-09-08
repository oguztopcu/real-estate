<?php

namespace App\Services\RealEstate;

class RealEstate
{
    /**
     * Postcode: CM27PJ
     *
     * first element latitude
     * second element longitude
     *
     * @var array $coordinates
     */
    private static $coordinates = [51.729157, 0.478027];

    public static function getCoordinates(): array
    {
        return self::$coordinates;
    }
}
