<?php

namespace App\Controllers;
use App\Controller;
use App\Models\ReservationService;
use App\Models\UserService;
use Exception;

class UserController extends Controller {

    private UserService $userService;

    public function __construct() {
        try {
            $this->userService = new UserService();
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function showRegisterForm(): void {
        startSessionIfNeeded();
        $this->render('/register');
    }

    public function register(): void {
        $errors = $this->userService->registerUser($_POST);

        // if the registration was successful, redirect to the login page
        if (empty($errors))
            redirectTo('/login');

        else
            $this->render('/register', ['errors' => $errors]);

    }


    public function showLoginForm(): void {
        startSessionIfNeeded();
        $this->render('/login');
    }

    public function login(): void {
        $errors = $this->userService->loginUser($_POST);

        // if the login was successful, redirect to the home page
        if (empty($errors)) {
            // start the session and store the user object in it
            startSessionIfNeeded();

            // if the user is already logged in, log out the user
            if (isset($_SESSION['user']))
                unset($_SESSION['user']);

            $user = $this->userService->getUserByEmail($_POST['email']);
            $_SESSION['user'] = serialize($user);
            redirectTo('/');
        }

        else
            $this->render('/login', ['errors' => $errors]);

    }

    public function logout(): void
    {
        // start the session and remove the user object from it
        startSessionIfNeeded();
        unset($_SESSION['user']);
        redirectTo('/');
    }

    public function showProfile(): void
    {
        startSessionIfNeeded();
        $user = unserialize($_SESSION['user']);

        $reservationService = new ReservationService();

        $reservations = $user->admin ? $reservationService->getReservationsWithCars() :
                        $reservationService->getReservationsWithCars($user->id);

        $this->render('/profile', ['user' => $user, 'reservations' => $reservations]);
    }

    public function unauthorized(): void
    {
        startSessionIfNeeded();
        $this->render('/unauthorized');
    }
}

?>