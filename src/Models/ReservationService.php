<?php

namespace App\Models;
use App\Models\Data\FileNames;
use App\Models\Data\JsonIO;
use App\Models\Data\Storage;
use Exception;

class ReservationService {
    private Storage $storage;

    public function __construct() {
        try {
            $this->storage = new Storage(new JsonIO(FileNames::$filePaths['reservations']), false);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function doDatesOverlap($start1, $end1, $start2, $end2) : bool {
        return $start1 < $end2 && $end1 > $start2;
    }

    public function isCarAvailable($id, $startDate, $endDate) : bool {
        // check if start date is before end date
        if ($startDate > $endDate)
            return false;

        $reservations = $this->storage->findAll(['carId' => $id]);
        foreach ($reservations as $reservation) {
            if ($this->doDatesOverlap($startDate, $endDate, $reservation->startDate, $reservation->endDate))
                return false;
        }

        return true;
    }

    public function addReservation($reservation): bool {
        // Check if the car is available for the given dates, if yes, add the reservation
        if ($this->isCarAvailable($reservation->carId, $reservation->startDate, $reservation->endDate)) {
            $this->storage->add($reservation);
            return true;
        }
        return false;
    }

    public function deleteReservation($id): void {
        $this->storage->delete($id);
    }

    public function getAllReservations(): array {
        return $this->storage->findAll();
    }

    public function getReservationsByUserId($userId): array {
        return $this->storage->findMany(function($reservation) use ($userId) {
            return $reservation->userId === $userId;
        });
    }

    public function getReservationsWithCars(?int $userId = null): array {
        try {
            $carService = new CarService();
        }
        catch (Exception $e) {
            echo "Error loading services: " . $e->getMessage();
            return []; // Return empty if there's an error loading services
        }

        // Fetch reservations based on whether a user ID is provided
        $reservations = $userId === null
            ? $this->getAllReservations()
            : $this->getReservationsByUserId($userId);

        $reservationsWithCars = [];

        // Fill the array with car details
        foreach ($reservations as $reservation) {
            $car = $carService->getCarById($reservation->carId);
            $reservationsWithCars[] = [
                'reservation' => $reservation,
                'car' => $car,
            ];
        }

        return $reservationsWithCars;
    }

    public function getReservationsByCarId($carId): array {
        return $this->storage->findMany(function($reservation) use ($carId) {
            return $reservation->carId === $carId;
        });
    }

}

?>