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
            <div class="row justify-content-center align-items-center w-100">
                <div class="col-12 col-md-10 col-lg-8">
                    <div class="card bg-dark text-light shadow-sm p-4">
                        <h2 class="text-center mb-4">Új autó hozzáadása</h2>
                        <form action="" method="POST">
                            <!-- Car Brand -->
                            <div class="mb-3">
                                <label for="brand" class="form-label">Márka</label>
                                <input type="text" class="form-control bg-secondary text-light border-0" id="brand"
                                    name="brand"
                                    value="<?= isset($_POST['brand']) ? htmlspecialchars($_POST['brand']) : '' ?>"
                                    required>
                            </div>

                            <!-- Car Model -->
                            <div class="mb-3">
                                <label for="model" class="form-label">Modell</label>
                                <input type="text" class="form-control bg-secondary text-light border-0" id="model"
                                    name="model"
                                    value="<?= isset($_POST['model']) ? htmlspecialchars($_POST['model']) : '' ?>"
                                    required>
                            </div>

                            <!-- Year -->
                            <div class="mb-3">
                                <label for="year" class="form-label">Évjárat</label>
                                <input type="number" class="form-control bg-secondary text-light border-0" id="year"
                                    name="year" min="1900" max="2100"
                                    value="<?= isset($_POST['year']) ? htmlspecialchars($_POST['year']) : '' ?>"
                                    required>
                            </div>

                            <!-- Transmission -->
                            <div class="mb-3">
                                <label for="transmission" class="form-label">Váltó típus</label>
                                <select class="form-select bg-secondary text-light border-0" id="transmission"
                                    name="transmission" required>
                                    <option value="Manual" <?= (isset($_POST['transmission']) && $_POST['transmission'] == 'Manual') ? 'selected' : '' ?>>Manuális</option>
                                    <option value="Automatic" <?= (isset($_POST['transmission']) && $_POST['transmission'] == 'Automatic') ? 'selected' : '' ?>>Automata</option>
                                </select>
                            </div>

                            <!-- Fuel Type -->
                            <div class="mb-3">
                                <label for="fuel_type" class="form-label">Üzemanyag típus</label>
                                <select class="form-select bg-secondary text-light border-0" id="fuel_type"
                                    name="fuelType" required>
                                    <option value="Petrol" <?= (isset($_POST['fuel_type']) && $_POST['fuel_type'] == 'Petrol') ? 'selected' : '' ?>>Benzin</option>
                                    <option value="Diesel" <?= (isset($_POST['fuel_type']) && $_POST['fuel_type'] == 'Diesel') ? 'selected' : '' ?>>Dízel</option>
                                    <option value="Electric" <?= (isset($_POST['fuel_type']) && $_POST['fuel_type'] == 'Electric') ? 'selected' : '' ?>>Elektromos</option>
                                </select>
                            </div>

                            <!-- Number of Passengers -->
                            <div class="mb-3">
                                <label for="passengers" class="form-label">Férőhelyek száma</label>
                                <input type="number" class="form-control bg-secondary text-light border-0"
                                    id="passengers" name="passengers" min="1" max="10"
                                    value="<?= isset($_POST['passengers']) ? htmlspecialchars($_POST['passengers']) : '' ?>"
                                    required>
                            </div>

                            <!-- Daily Price -->
                            <div class="mb-3">
                                <label for="daily_price_huf" class="form-label">Napidíj (HUF)</label>
                                <input type="number" class="form-control bg-secondary text-light border-0"
                                    id="daily_price_huf" name="dailyPriceHuf" min="0"
                                    value="<?= isset($_POST['daily_price_huf']) ? htmlspecialchars($_POST['daily_price_huf']) : '' ?>"
                                    required>
                            </div>

                            <!-- Car Image URL -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Kép URL</label>
                                <input type="url" class="form-control bg-secondary text-light border-0" id="image"
                                    name="image"
                                    value="<?= isset($_POST['image']) ? htmlspecialchars($_POST['image']) : '' ?>"
                                    required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn highlightBtn">Autó hozzáadása</button>
                            </div>
                        </form>
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