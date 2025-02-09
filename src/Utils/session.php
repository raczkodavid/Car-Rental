<?php

function startSessionIfNeeded() : void  {
    if (session_status() == PHP_SESSION_NONE)
        session_start();
}

function isAdminLoggedIn() {
    startSessionIfNeeded();
    if (!isset($_SESSION['user']))
        return false;

    return unserialize($_SESSION['user'])->admin;
}

?>