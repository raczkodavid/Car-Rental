<?php

namespace App\Controllers;
use App\Controller;
use App\Models\Car;
use App\Models\CarService;
use App\Models\ReservationService;
use Exception;

class CarController extends Controller
{
    private CarService $carService;

    public function __construct()
    {
        try {
            $this->carService = new CarService();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function displayCarDetails(): void
    {
        startSessionIfNeeded();

        $carId = $_GET['id'] ?? null;
        if (!$carId)
            redirectTo('/');

        $car = $this->carService->getCarById((int) $carId);

        $this->render('/carDetails', ['car' => $car]);
    }

    // (ADMINS ONLY)
    public function deleteCar(): void
    {
        if (!isAdminLoggedIn())
            redirectTo('/unauthorized');

        $carId = $_GET['id'] ?? null;
        if (!$carId)
            redirectTo('/');

        $this->carService->deleteCar((int) $carId);
        redirectTo('/');
    }

    // (ADMINS ONLY)
    public function showAddCarForm(): void
    {
        startSessionIfNeeded();

        // check if user has permission to do this
        if (!isAdminLoggedIn())
            redirectTo('/unauthorized');

        $this->render('/addCar');
    }

    // POST request on addCar.php
    public function addCar(): void
    {
        if (!isAdminLoggedIn())
            redirectTo('/unauthorized');

        // if the car data is invalid, redirect back to the form
        if (!$this->validateCarData($_POST))
            redirectTo('/addCar');

        $car = new Car(
            $_POST['brand'],
            $_POST['model'],
            (int) $_POST['year'],
            $_POST['transmission'],
            $_POST['fuelType'],
            (int) $_POST['passengers'],
            (int) $_POST['dailyPriceHuf'],
            $_POST['image']
        );

        $this->carService->addCar($car);

        redirectTo('/');
    }

    // (ADMINS ONLY)
    public function showModifyCarForm(): void
    {
        if (!isAdminLoggedIn())
            redirectTo('/unauthorized');

        startSessionIfNeeded();
        $carId = $_GET['id'] ?? null;

        if (!$carId)
            redirectTo('/');

        $car = $this->carService->getCarById((int) $carId);

        // get reservations for the car
        $reservationService = new ReservationService();
        $reservations = $reservationService->getReservationsByCarId((int) $carId);

        $this->render('/modifyCar', ['car' => $car, 'reservations' => $reservations]);
    }

    private function validateCarData($data): bool
    {
        // check if every field is filled
        if (
            empty($data['brand']) || empty($data['model']) || empty($data['year']) || empty($data['transmission']) ||
            empty($data['fuelType']) || empty($data['passengers']) || empty($data['dailyPriceHuf']) || empty($data['image'])
        ) {
            return false;
        }

        // check if year is between 1900 and 2100
        if ((int) $data['year'] < 1900 || (int) $data['year'] > 2025)
            return false;

        // check if passengers is between 1 and 10
        if ((int) $data['passengers'] < 1 || (int) $data['passengers'] > 10)
            return false;

        // check if daily price is positive
        if ((int) $data['dailyPriceHuf'] < 0)
            return false;

        return true;
    }

    // (ADMINS ONLY)
    public function modifyCar(): void
    {
        if (!isAdminLoggedIn())
            redirectTo('/unauthorized');

        // if the car data is invalid, redirect back to the form
        if (!$this->validateCarData($_POST))
            redirectTo('/modifyCar?id=' . $_POST['id']);

        $car = new Car(
            $_POST['brand'],
            $_POST['model'],
            (int) $_POST['year'],
            $_POST['transmission'],
            $_POST['fuelType'],
            (int) $_POST['passengers'],
            (int) $_POST['dailyPriceHuf'],
            $_POST['image']
        );

        // add the car to the database
        $this->carService->modifyCar((int) $_POST['id'], $car);

        // redirect to the home page
        redirectTo('/');

    }
}

?>