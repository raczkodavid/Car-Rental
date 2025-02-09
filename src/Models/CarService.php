<?php

namespace App\Models;
use App\Models\Data\FileNames;
use App\Models\Data\JsonIO;
use App\Models\Data\Storage;
use Exception;

class CarService {
    private Storage $storage;

    public function __construct() {
        try {
            $this->storage = new Storage(new JsonIO(FileNames::$filePaths['cars']), false);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getFilteredCars(array $filters): array {
        $cars = $this->storage->findAll();

        if (empty($filters))
            return $cars;

        return array_filter($cars, fn($car) => $this->matchesFilters($car, $filters));
    }

    private function matchesFilters($car, array $filters): bool {
        // Check passengers
        if ($car->passengers < $filters['passengers'])
            return false;

        // Check daily price
        if (!$this->matchesPrice($car, $filters))
            return false;

        // Check transmission
        if (isset($filters['transmission']) && $car->transmission !== $filters['transmission'])
            return false;

        // check availability
        if (!$this->isCarAvailableForDates($car->id, $filters))
            return false;

        return true;
    }

    private function matchesPrice($car, array $filters): bool {
        // Get the minPrice and maxPrice from the filters
        $minPrice = $filters['minPrice'];
        $maxPrice = $filters['maxPrice'];

        // If minPrice is less than or equal to 0, we don't apply the min price filter
        if ($minPrice > 0 && $car->dailyPriceHuf < $minPrice)
            return false; // Car's price is below the minimum price

        // If maxPrice is less than or equal to 0, we don't apply the max price filter
        if ($maxPrice > 0 && $car->dailyPriceHuf > $maxPrice)
            return false; // Car's price is above the maximum price

        // If both minPrice and maxPrice are 0 or less, we don't filter the car's price
        return true;
    }



    private function isCarAvailableForDates(int $carId, array $filters): bool {
        if (!isset($filters['startDate'], $filters['endDate']))
            return true; // If dates are not set, don't filter by availability

        // Instantiate the ReservationService only when needed
        $reservationService = new ReservationService();
        return $reservationService->isCarAvailable($carId, $filters['startDate'], $filters['endDate']);
    }

    public function modifyCar($id, $car): void {
        $this->storage->update($id, $car);
    }

    public function addCar($car): string {
        return $this->storage->add($car);
    }

    public function deleteCar($id): void {
        $this->storage->delete($id);
    }

    public function getCarById($id) {
        return $this->storage->findById($id);
    }
}

?>