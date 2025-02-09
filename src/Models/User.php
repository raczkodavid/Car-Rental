<?php

namespace App\Models;

class User {
    public int $id;
    public string $fullName;
    public string $email;
    public string $password;
    public bool $admin;

    public function __construct($fullName, $email, $password, $admin) {
        $this->id = hexdec(uniqid());
        $this->fullName = $fullName;
        $this->email = $email;
        $this->password = $password;
        $this->admin = $admin;
    }
}

?>