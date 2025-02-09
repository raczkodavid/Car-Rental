<?php

namespace App\Models\Data;
use Exception;

abstract class FileIO implements IFileIO {
    protected string $filepath;

    public function __construct($filename) {
        if (!is_readable($filename) || !is_writable($filename))
            throw new Exception("Data source $filename is invalid.");

        $this->filepath = realpath($filename);
    }
}

?>