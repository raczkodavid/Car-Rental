<?php include_once 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Details - <?= htmlspecialchars($car->brand) ?> <?= htmlspecialchars($car->model) ?></title>
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

        <!-- Main Content -->
        <div class="container my-auto">
            <div class="row text-center mb-1">
                <div class="col-12">
                    <h1 class="display-4 fw-bold"><?= htmlspecialchars($car->brand) ?>
                        <?= htmlspecialchars($car->model) ?></h1>
                    <p><i>Az ideális autó bármilyen alkalomra</i></p>
                </div>
            </div>

            <div class="row align-items-stretch gy-4 d-flex justify-content-center">
                <!-- Car Image -->
                <div class="col-lg-6 d-flex justify-content-center">
                    <div class="d-flex align-items-center w-100">
                        <img src="<?= htmlspecialchars($car->image) ?>"
                            alt="<?= htmlspecialchars($car->brand) ?> <?= htmlspecialchars($car->model) ?>"
                            class="img-fluid w-100">
                    </div>
                </div>

                <div class="col-lg-6 d-flex align-items-stretch text-center">
                    <div class="card w-100 shadow p-4 bg-dark text-light">
                        <h2 class="card-title text-center mb-4 text-light">Autó Részletei</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item bg-dark text-light">
                                <strong>Évjárat:</strong> <?= htmlspecialchars($car->year) ?>
                            </li>
                            <li class="list-group-item bg-dark text-light">
                                <strong>Váltó:</strong>
                                <?= htmlspecialchars(getTransmissionLabel($car->transmission)) ?>
                            </li>
                            <li class="list-group-item bg-dark text-light">
                                <strong>Üzemanyag:</strong> <?= htmlspecialchars(getFuelTypeLabel($car->fuelType)) ?>
                            </li>
                            <li class="list-group-item bg-dark text-light">
                                <strong>Férőhelyek:</strong> <?= htmlspecialchars($car->passengers) ?>
                            </li>
                            <li class="list-group-item bg-dark text-light">
                                <strong>Napi ár:</strong> <?= number_format($car->dailyPriceHuf, 0, ',', ' ') ?> HUF
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row mt-4 mb-2 justify-content-center">
                <div class="col-lg-6 text-center">
                    <form action="/reservation" method="POST">
                        <input type="hidden" name="carId" value="<?= $car->id ?>">
                        <div class="d-flex justify-content-center mb-3">
                            <div class="mx-2">
                                <label for="start_date" class="form-label">Kezdő dátum</label>
                                <input type="date" id="start_date" name="startDate" class="form-control" required>
                            </div>

                            <div class="mx-2">
                                <label for="end_date" class="form-label">Befejező dátum</label>
                                <input type="date" id="end_date" name="endDate" class="form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn highlightBtn">Foglalás</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>