<?php

// This file contains all route mappings for the application
use App\Controllers\MainController;
use App\Controllers\CarController;
use App\Controllers\ReservationController;

use App\Controllers\UserController;
use App\Router;

$router = new Router();

// Main page
$router->get('/', MainController::class, 'index');
$router->post('/', MainController::class,'index');

// Car details page
$router->get('/carDetails', CarController::class, 'displayCarDetails');

// Login page
$router->get('/login', UserController::class, 'showLoginForm');
$router->post('/login', UserController::class, 'login');

// Register page
$router->get('/register', UserController::class, 'showRegisterForm');
$router->post('/register', UserController::class, 'register');

// Logout
$router->get('/logout', UserController::class, 'logout');

// Profile page
$router->get('/profile', UserController::class, 'showProfile');

// Reservation
$router->post('/reservation', ReservationController::class, 'reserve');
$router->get('/success', ReservationController::class, 'success');
$router->get('/failure', ReservationController::class, 'failure');


// Add car, delete car, modify car
$router->get('/addCar', CarController::class, 'showAddCarForm');
$router->post('/addCar', CarController::class, 'addCar');

$router->get('/deleteCar', CarController::class, 'deleteCar');

$router->get('/modifyCar', CarController::class, 'showModifyCarForm');
$router->post('/modifyCar', CarController::class, 'modifyCar');

// Delete reservation from the car details page
$router->post('/deleteReservation', ReservationController::class, 'deleteReservation');

$router->get("/unauthorized", UserController::class, "unauthorized");

return $router;

?>