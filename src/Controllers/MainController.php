<?php

namespace App\Controllers;
use App\Controller;
use App\Models\CarService;

class MainController extends Controller
{

    // Method that handles GET and POST requests on index.php
    public function index(): void
    {
        startSessionIfNeeded();

        $carService = new CarService();
        // Get all cars if no filter is set by the user, otherwise cars that satisfy the conditions of the filters
        $carsToDisplay = $carService->getFilteredCars($_POST);

        $user = isset($_SESSION['user']) ? unserialize($_SESSION['user']) : null;
        $this->render('index', ['user' => $user, 'carsToDisplay' => $carsToDisplay]);
    }
}

?>