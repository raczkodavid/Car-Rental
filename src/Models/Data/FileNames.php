<?php

namespace App\Models\Data;

class FileNames {
    public static array $filePaths = [
        'users' => __DIR__ . '/users.json',
        'reservations' => __DIR__ . '/reservations.json',
        'cars' => __DIR__ . '/availableCars.json',
    ];
}

?>