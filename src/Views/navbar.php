<?php

function navbar(): void { ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid m-2">
            <a class="navbar-brand" href="/">IkarRental</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <li class="nav-item mt-3 mt-sm-0 mb-2 mb-sm-0 d-flex align-items-center">
                            <a href="/logout" class="nav-link btn highlightBtn text-center w-100 w-sm-auto">Kijelentkezés</a>
                        </li>
                        <li class="nav-item d-sm-none mt-2">
                            <a href="/profile" class="nav-link btn highlightBtn2 text-center w-100">Profilom</a>
                        </li>
                        <li class="nav-item d-none d-sm-block ms-3 d-flex align-items-center">
                            <a href="/profile" class="d-flex align-items-center">
                                <img src="https://www.w3schools.com/howto/img_avatar.png" class="rounded-circle avatar">
                            </a>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item mt-3 mt-sm-0 mb-2 mb-sm-0">
                            <a href="/login" class="nav-link btn highlightBtn2 text-center">Bejelentkezés</a>
                        </li>
                        <li class="nav-item mt-2 mt-sm-0 mb-2 mb-sm-0 ms-sm-3">
                            <a href="/register" class="nav-link btn highlightBtn text-center w-100 w-sm-auto">Regisztráció</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>

<?php }
