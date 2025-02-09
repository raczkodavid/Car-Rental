<?php include_once "navbar.php" ?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hozzáférés megtagadva</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="d-flex flex-column vh-100">
        <!-- Navbar -->
        <?= navbar() ?>
        <div class="bg-gradient bg-dark d-flex justify-content-center align-items-center vh-100">
            <div class="text-center p-4 rounded shadow-sm bg-dark unauth">
                <h1 class="display-4 text-danger fw-bold">Hozzáférés megtagadva</h1>
                <p class="text">Ön nem rendelkezik jogosultsággal az oldal megtekintéséhez.</p>
                <a href="/" class="btn deleteButton mt-3">Vissza a főoldalra</a>
            </div>
        </div>
        <!-- Bootstrap script-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
</body>

</html>