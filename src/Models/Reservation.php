<?php 

namespace App\Models;

class Reservation {
    public int $id;
    public int $userId;
    public string $userEmail;
    public int $carId;
    public string $startDate;
    public string $endDate;

    public function __construct($userId, $userEmail, $carId, $startDate, $endDate) {
        $this->id = hexdec(uniqid());
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->userId = $userId;
        $this->carId = $carId;
        $this->userEmail = $userEmail;
    }
}
?>