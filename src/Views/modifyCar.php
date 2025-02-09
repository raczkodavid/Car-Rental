<?php include_once 'navbar.php'; ?>

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
    <div class="d-flex flex-column min-vh-100">
        <!-- Navbar -->
        <?= navbar() ?>

        <!-- Content -->
        <div class="container mt-4 mb-4 d-flex justify-content-center align-items-center flex-grow-1">
            <div class="row justify-content-center align-items-stretch w-100">
                <div class="col-12 col-lg-6 mb-4 mb-lg-0">
                    <div class="card bg-dark text-light shadow-sm p-4 h-100">
                        <h2 class="text-center mb-4">Autó Módosítása</h2>
                        <form action="" method="POST">
                            <!-- Car Brand -->
                            <div class="mb-3">
                                <label for="brand" class="form-label">Márka</label>
                                <input type="text" class="form-control bg-secondary text-light border-0" id="brand"
                                    name="brand" value="<?= isset($car->brand) ? htmlspecialchars($car->brand) : '' ?>"
                                    required>
                            </div>

                            <!-- Car Model -->
                            <div class="mb-3">
                                <label for="model" class="form-label">Modell</label>
                                <input type="text" class="form-control bg-secondary text-light border-0" id="model"
                                    name="model" value="<?= isset($car->model) ? htmlspecialchars($car->model) : '' ?>"
                                    required>
                            </div>

                            <!-- Year -->
                            <div class="mb-3">
                                <label for="year" class="form-label">Évjárat</label>
                                <input type="number" class="form-control bg-secondary text-light border-0" id="year"
                                    name="year" min="1900" max="2100"
                                    value="<?= isset($car->year) ? htmlspecialchars($car->year) : '' ?>" required>
                            </div>

                            <!-- Transmission -->
                            <div class="mb-3">
                                <label for="transmission" class="form-label">Váltó típus</label>
                                <select class="form-select bg-secondary text-light border-0" id="transmission"
                                    name="transmission" required>
                                    <option value="Manual" <?= (isset($car->transmission) && $car->transmission == 'Manual') ? 'selected' : '' ?>>Manuális</option>
                                    <option value="Automatic" <?= (isset($car->transmission) && $car->transmission == 'Automatic') ? 'selected' : '' ?>>Automata</option>
                                </select>
                            </div>

                            <!-- Fuel Type -->
                            <div class="mb-3">
                                <label for="fuelType" class="form-label">Üzemanyag típus</label>
                                <select class="form-select bg-secondary text-light border-0" id="fuelType"
                                    name="fuelType" required>
                                    <option value="Petrol" <?= (isset($car->fuelType) && $car->fuelType == 'Petrol') ? 'selected' : '' ?>>Benzin</option>
                                    <option value="Diesel" <?= (isset($car->fuelType) && $car->fuelType == 'Diesel') ? 'selected' : '' ?>>Dízel</option>
                                    <option value="Electric" <?= (isset($car->fuelType) && $car->fuelType == 'Electric') ? 'selected' : '' ?>>Elektromos</option>
                                </select>
                            </div>

                            <!-- Number of Passengers -->
                            <div class="mb-3">
                                <label for="passengers" class="form-label">Férőhelyek száma</label>
                                <input type="number" class="form-control bg-secondary text-light border-0"
                                    id="passengers" name="passengers" min="1" max="10"
                                    value="<?= isset($car->passengers) ? htmlspecialchars($car->passengers) : '' ?>"
                                    required>
                            </div>

                            <!-- Daily Price -->
                            <div class="mb-3">
                                <label for="dailyPriceHuf" class="form-label">Napidíj (HUF)</label>
                                <input type="number" class="form-control bg-secondary text-light border-0"
                                    id="dailyPriceHuf" name="dailyPriceHuf" min="0"
                                    value="<?= isset($car->dailyPriceHuf) ? htmlspecialchars($car->dailyPriceHuf) : '' ?>"
                                    required>
                            </div>

                            <!-- Car Image URL -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Kép URL</label>
                                <input type="url" class="form-control bg-secondary text-light border-0" id="image"
                                    name="image" value="<?= isset($car->image) ? htmlspecialchars($car->image) : '' ?>"
                                    required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-center">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($car->id) ?>">
                                <button type="submit" class="btn highlightBtn">Módosít</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Reservations Section -->
                <div class="col-12 col-lg-6">
                    <div class="card bg-dark text-light shadow-sm p-4 h-100">
                        <h3 class="text-center">Foglalások</h3>

                        <!-- Card layout for mobile -->
                        <div class="d-block d-lg-none">
                            <?php foreach ($reservations as $reservation): ?>
                                <div class="card bg-dark text-light p-3 mb-3">
                                    <div class="card-body text-center"> <!-- Center everything in the card body -->
                                        <p class="card-title"><strong>Felhasználó</strong>:
                                            <strong><?= htmlspecialchars($reservation->userEmail) ?></strong></p>
                                        <p class="card-text"><strong>Kezdő dátum:</strong>
                                            <?= htmlspecialchars($reservation->startDate) ?></p>
                                        <p class="card-text"><strong>Befejező dátum:</strong>
                                            <?= htmlspecialchars($reservation->endDate) ?></p>
                                        <form action="/deleteReservation" method="POST" class="d-inline">
                                            <input type="hidden" name="reservationId"
                                                value="<?= htmlspecialchars($reservation->id) ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Törlés</button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Regular table layout for larger screens -->
                        <div class="table-responsive d-none d-lg-block">
                            <table class="table table-dark table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Felhasználó email címe</th>
                                        <th scope="col">Kezdő dátum</th>
                                        <th scope="col">Befejező dátum</th>
                                        <th scope="col">Művelet</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reservations as $reservation): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($reservation->userEmail) ?></td>
                                            <td><?= htmlspecialchars($reservation->startDate) ?></td>
                                            <td><?= htmlspecialchars($reservation->endDate) ?></td>
                                            <td>
                                                <!-- Delete button -->
                                                <form action="/deleteReservation" method="POST" class="d-inline">
                                                    <!-- Hidden input to send car ID to the server -->
                                                    <input type="hidden" name="carId"
                                                        value="<?= htmlspecialchars($car->id) ?>">
                                                    <input type="hidden" name="reservationId"
                                                        value="<?= htmlspecialchars($reservation->id) ?>">
                                                    <button type="submit" class="btn deleteButton btn-sm">Törlés</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap script-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
</body>

</html>