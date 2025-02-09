<?php

require '../vendor/autoload.php';

// Load the router and mappings
$router = require '../src/Routes/index.php';

// Dispatch the current request
$router->dispatch();

?>