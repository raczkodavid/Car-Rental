<?php

function redirectTo($location) : void  {
    header("Location: $location");
    exit();
}

?>