<?php

namespace App\Models;

class Car {
    public int $id;
    public string $brand;
    public string $model;
    public int $year;
    public string $transmission;
    public string $fuelType;
    public int $passengers;
    public int $dailyPriceHuf;
    public string $image;

    // constructor
    function __construct($brand, $model, $year, $transmission, $fuelType, $passengers, $dailyPriceHuf, $image) {
        $this->id = hexdec(uniqid());
        $this->brand = $brand;
        $this->model = $model;
        $this->year = $year;
        $this->transmission = $transmission;
        $this->fuelType = $fuelType;
        $this->passengers = $passengers;
        $this->dailyPriceHuf = $dailyPriceHuf;
        $this->image = $image;
    }
}

?>