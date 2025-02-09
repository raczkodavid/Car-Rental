<?php

namespace App\Models\Data;

interface IFileIO {
    function save($data);
    function load();
}

?>