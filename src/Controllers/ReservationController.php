<?php

namespace App\Controllers;

use App\Controller;
use App\Models\CarService;
use App\Models\Reservation;
use App\Models\ReservationService;
use Exception;

class ReservationController extends Controller {

    private ReservationService $reservationService;

    public function __construct() {
        try {
            $this->reservationService = new ReservationService();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function reserve(): void {
        // check if the user is logged in, if not redirect to the login page
        startSessionIfNeeded();
        if (!isset($_SESSION['user']))
            redirectTo('/login');

        // extract the carId, startDate and endDate from the POST request
        $carId = (int)$_POST["carId"];
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];

        // Get the user object from the session
        $user = unserialize($_SESSION["user"]);

        $reservation = new Reservation($user->id, $user->email ,$carId, $startDate, $endDate);

        $success = $this->reservationService->addReservation($reservation);

        // Redirect to the success or failure page based on the success of the reservation
        $carService = new CarService();
        $car = $carService->getCarById($carId);
        $dataToPass = [
            "carId" => $carId,
            "carName" => $car->brand . " " . $car->model,
            "startDate" => $reservation->startDate,
            "endDate" => $reservation->endDate
        ];

        // store it in the session
        $_SESSION['data'] = $dataToPass;

        if ($success)
            redirectTo('/success');

        else
            redirectTo('/failure');
    }

    public function deleteReservation(): void {
        if (!isAdminLoggedIn())
            redirectTo('/unauthorized');

        if (!isset($_POST['reservationId']))
            redirectTo('/');

        $reservationId = (int)$_POST['reservationId'];
        $this->reservationService->deleteReservation($reservationId);

        if (!isset($_POST['carId']))
            redirectTo('/profile');

        redirectTo('/modifyCar?id=' . $_POST['carId']);
    }

    public function success(): void {
        startSessionIfNeeded();
        $data = $_SESSION['data'];
        // unset the session variable
        unset($_SESSION['data']);
        $this->render('/success', $data);
    }

    public function failure(): void {
        startSessionIfNeeded();
        $data = $_SESSION['data'];
        // unset the session variable
        unset($_SESSION['data']);
        $this->render('/failure', $data);
    }
}

?>