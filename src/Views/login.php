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
        <div class="d-flex align-items-center justify-content-center flex-grow-1">
            <div class="container loginContainer">
                <div class="row text-center">
                    <h1 class="display-2"><b>Bejelentkezés</b></h1>
                </div>
                <div class="row mt-3 justify-content-center">
                    <div class="col-sm-12 col-md-10 col-lg-8">
                        <form action="" method="POST">
                            <div>
                                <label for="email" class="form-label">Email cím</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email"
                                    placeholder="lakatos.brendon@ikarrental.com" required>
                            </div>
                            <div class="mt-3">
                                <label for="password" class="form-label">Jelszó</label>
                                <input type="password" class="form-control form-control-lg" id="password"
                                    name="password" placeholder="*************" required>
                            </div>
                            <div class="mt-5 text-center">
                                <button type="submit" class="btn highlightBtn btn-lg">Belépés</button>
                            </div>
                        </form>
                        <!-- List of errors -->
                        <?php if (!empty($errors)): ?>
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-md-10 col-lg-8 mt-5">
                                    <div class="alert alert-danger text-center" role="alert">
                                        <?php foreach ($errors as $error): ?>
                                            <div><?= htmlspecialchars($error) ?></div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
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