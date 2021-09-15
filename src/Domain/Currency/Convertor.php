<?php

namespace App\Domain\Currency;

class Convertor {

    private float $USDollarValue;
    private float $euroValue;

    public function __construct(float $USDollarValue, float $euroValue)
    {
        $this->USDollarValue = $USDollarValue;
        $this->euroValue = $euroValue;
    }

    public function euroToDollar(float $price): float
    {
        return $price * $this->USDollarValue;
    }

    public function dollarToEuro(float $price): float
    {
        return $price * $this->euroValue;
    }
}