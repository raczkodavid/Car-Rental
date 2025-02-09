<?php

namespace App\Models\Data;

class JsonIO extends FileIO {
    public function load(bool $assoc = true): mixed {
        $file_content = file_get_contents($this->filepath);
        return json_decode($file_content, $assoc) ?? [];
    }

    public function save(mixed $data): void {
        $json_content = json_encode($data, JSON_PRETTY_PRINT);
        file_put_contents($this->filepath, $json_content);
    }
}

?>