<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IKar Rental - YCFCIY</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- Navbar -->
    <?= navbar() ?>

    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Kölcsönözz autókat könnyedén!</h1>
            <p class="lead">Fedezd fel a legjobb autókölcsönzési ajánlatokat, bárhol, bármikor.</p>
            <a href="/register" class="btn highlightBtn">Regisztráció</a>
        </div>
    </section>

    <section id="filterSection">
        <div class="container">
            <h2 class="text-center mb-2">Szűrő beállítások</h2>

            <div class="text-center mb-3">
                <button class="btn highlightBtn2" type="button" data-bs-toggle="collapse" data-bs-target="#filterForm"
                    aria-expanded="false" aria-controls="filterForm">
                    Megnyitás/Bezárás
                </button>
                <?php if (isset($_SESSION['user']) && $user->admin) { ?>
                    <a href="/addCar" class="btn modifyButton">Autó Hozzáadása</a>
                <?php } ?>
            </div>

            <!-- Collapsible Content -->
            <div class="collapse" id="filterForm">
                <form action="" method="POST">
                    <div class="row">
                        <!-- Number of Passengers -->
                        <div class="col-md-3 mb-3">
                            <label for="passengers" class="form-label">Férőhelyek</label>
                            <input type="number" class="form-control text-center" id="passengers" name="passengers"
                                value="<?= htmlspecialchars($_POST['passengers'] ?? '1') ?>" min="1" required>
                        </div>

                        <!-- Start and End Date -->
                        <div class="col-md-3 mb-3">
                            <label for="startDate" class="form-label">Kezdő Dátum</label>
                            <input type="date" class="form-control" id="startDate" name="startDate"
                                value="<?= htmlspecialchars($_POST['startDate'] ?? '') ?>">
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="endDate" class="form-label">Befejező Dátum</label>
                            <input type="date" class="form-control" id="endDate" name="endDate"
                                value="<?= htmlspecialchars($_POST['endDate'] ?? '') ?>">
                        </div>

                        <!-- Transmission Type -->
                        <div class="col-md-3 mb-3">
                            <label for="transmissionType" class="form-label">Váltó Típusa</label>
                            <select class="form-select" id="transmission" name="transmission">
                                <option value="" disabled <?= empty($_POST['transmission']) ? 'selected' : '' ?>>Válassz
                                    váltótípust</option>
                                <option value="Automatic" <?= (isset($_POST['transmission']) && $_POST['transmission'] === 'Automatic') ? 'selected' : '' ?>>Automata</option>
                                <option value="Manual" <?= (isset($_POST['transmission']) && $_POST['transmission'] === 'Manual') ? 'selected' : '' ?>>Manuális</option>
                            </select>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-3">
                            <label for="minPrice" class="form-label">Ár (Min)</label>
                            <input type="number" class="form-control" id="minPrice" name="minPrice"
                                value="<?= htmlspecialchars($_POST['minPrice'] ?? '') ?>" placeholder="Min Ár">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="maxPrice" class="form-label">Ár (Max)</label>
                            <input type="number" class="form-control" id="maxPrice" name="maxPrice"
                                value="<?= htmlspecialchars($_POST['maxPrice'] ?? '') ?>" placeholder="Max Ár">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="row justify-content-center mt-4 mb-4">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn highlightBtn">Szűrés</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Car List Section -->
    <section id="carListSection">
        <div class="container-fluid mt-2 text-center">
            <div class="row justify-content-center">
                <?php foreach ($carsToDisplay as $car): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
                        <div class="card h-100 d-flex flex-column bg-dark text-light">
                            <a href="/carDetails?id=<?= htmlspecialchars($car->id) ?>"> <img
                                    src="<?= htmlspecialchars($car->image) ?>" class="card-img-top car-image"
                                    alt="<?= htmlspecialchars($car->brand . ' ' . $car->model) ?>">
                                <div class="card-body d-flex flex-column">
                                    <a href="/carDetails?id=<?= htmlspecialchars($car->id) ?>"
                                        class="card-title h5 text-white text-decoration-none"><?= htmlspecialchars($car->brand . ' ' . $car->model) ?></a>
                                    <span class="card-text"><?= htmlspecialchars($car->passengers) ?> férőhely,
                                        <?= htmlspecialchars(getTransmissionLabel($car->transmission)) ?></span>
                                    <span class="card-text mb-1"><?= number_format($car->dailyPriceHuf, 0, '.', '.') ?> HUF
                                        / nap</span>
                                    <div class="mt-1 mb-1">
                                        <a href="/carDetails?id=<?= htmlspecialchars($car->id) ?>"
                                            class="btn highlightBtn">Foglalás</a>
                                    </div>
                                    <?php if (isset($_SESSION['user']) && $user->admin) { ?>
                                        <div class="mt-1">
                                            <a href="/deleteCar?id=<?= htmlspecialchars($car->id) ?>"
                                                class="btn deleteButton">Törlés</a>
                                            <a href="/modifyCar?id=<?= htmlspecialchars($car->id) ?>"
                                                class="btn modifyButton">Szerkesztés</a>
                                        </div>
                                    <?php } ?>
                                </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>