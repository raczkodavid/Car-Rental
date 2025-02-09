<?php

function getTransmissionLabel(string $transmission) : string {
    return match ($transmission) {
        'Manual' => 'Manuális',
        'Automatic' => 'Automata',
        default => '',
    };
}

function getFuelTypeLabel(string $fuelType) : string {
    return match ($fuelType) {
        'Petrol' => 'Benzin',
        'Diesel' => 'Dízel',
        'Electric' => 'Elektromos',
        default => '',
    };
}

?>