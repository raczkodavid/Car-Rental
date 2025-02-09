<?php
include_once 'navbar.php';
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKar Rental - YCFCIY</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="d-flex flex-column vh-100">
        <!-- Navbar -->
        <?= navbar() ?>

        <!-- Content -->
        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col-12 col-md-3 text-center mb-4 mb-md-0">
                    <img src="https://www.w3schools.com/howto/img_avatar.png" class="img-fluid rounded-5 w-75"
                        alt="User Photo">
                </div>
                <div
                    class="col-12 col-md-9 d-flex flex-column align-items-center align-items-md-start justify-content-md-center text-center text-md-start">
                    <h3 class="fs-3">Bejelentkezve mint:</h3>

                    <h2 class="fs-1 <?= $user->admin ? 'admin' : '' ?>"><b><?= $user->fullName ?></b></h2>
                    <p class="fs-4"><i><?= $user->email ?></i></p>
                </div>
            </div>

            <!-- Display reservation cards -->
            <div class="row justify-content-center">
                <h2 class="display-4 text-center mb-3"><b><?= $user->admin ? 'Foglalások' : 'Foglalásaim' ?></b></h2>
                <?php foreach ($reservations as $reservation): ?>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3">
                        <div class="card h-100 d-flex flex-column bg-dark text-light">
                            <img src="<?= $reservation['car']->image ?>" class="card-img-top car-image"
                                alt="<?= $reservation['car']->model . ' ' . $reservation['car']->model ?>">
                            <div class="card-body text-center d-flex flex-column">
                                <span
                                    class="card-title h5"><?= $reservation['car']->brand . ' ' . $reservation['car']->model ?></span>
                                <span class="card-text"><?= $reservation['car']->passengers ?> férőhely,
                                    <?= $reservation['car']->transmission ?></span>
                                <span
                                    class="card-text mb-1"><?= number_format($reservation['car']->dailyPriceHuf, 0, '.', '.') ?>
                                    HUF / nap</span>
                                <span class="card-text mb-1">Foglalás időtartama:</span>
                                <span class="card-text mb-1"><?= $reservation['reservation']->startDate ?> -
                                    <?= $reservation['reservation']->endDate ?></span>
                                <!-- If admin is logged in, display the user's email, and a Delete button -->
                                <?php if ($user->admin): ?>
                                    <span class="card-text mb-1">Foglaló:
                                        <b><i><?= $reservation['reservation']->userEmail ?></b></i></span>
                                    <form action="/deleteReservation" method="POST">
                                        <input type="hidden" name="reservationId"
                                            value="<?= $reservation['reservation']->id ?>">
                                        <button type="submit" class="btn btn-danger mt-auto">Foglalás törlése</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>