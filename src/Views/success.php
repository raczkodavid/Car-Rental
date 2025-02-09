<?php
include_once 'navbar.php';
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKar Rental - Sikeres Foglalás</title>
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
        <div class="d-flex align-items-center justify-content-center flex-grow-1">
            <div class="container text-center">
                <div class="row justify-content-center mb-4">
                    <div class="col-5 col-md-3 col-lg-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/ff/Eo_circle_yellow_checkmark.svg/2048px-Eo_circle_yellow_checkmark.svg.png"
                            alt="Success" class="img-fluid">
                    </div>
                </div>
                <h3 class="display-5 mb-3">Sikeres foglalás!</h3>
                <p class="lead mb-4">
                    A(z) <b><?= $carName ?></b> sikeresen lefoglalva <b><?= $startDate ?></b> - <b><?= $endDate ?></b>
                    intervallumra.<br>
                    Foglalásod státuszát a profiloldalon követheted nyomon.
                </p>
                <a href="/profile" class="btn highlightBtn">Profilom</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>