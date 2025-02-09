<?php

namespace App\Models;
use App\Models\Data\FileNames;
use App\Models\Data\JsonIO;
use App\Models\Data\Storage;
use Exception;

class UserService
{
    private Storage $storage;

    public function __construct()
    {
        try {
            $this->storage = new Storage(new JsonIO(FileNames::$filePaths['users']), false);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getUserByEmail(string $email)
    {
        return $this->storage->findOne(['email' => $email]);
    }

    public function registerUser(array $userData): array
    {
        $errors = $this->validateUserData($userData);

        // Return errors if any validation fails
        if (!empty($errors))
            return $errors;

        // Hash the password securely
        $hashedPassword = password_hash($userData['password'], PASSWORD_BCRYPT);

        // Create a new User object
        $user = new User(
            $userData['fullName'],
            $userData['email'],
            $hashedPassword,
            $userData['admin'] ?? false // Default to false if 'admin' key isn't provided
        );

        // Save the user to the database
        $this->storage->add($user);

        return [];
    }

    // Validates user data and returns an array of errors
    private function validateUserData(array $userData): array
    {
        $errors = [];

        // Basic field checks
        if (empty($userData['email']) || empty($userData['password']) || empty($userData['fullName'] || empty($userData['confirmPassword']))) {
            $errors[] = "All fields are required.";
            return $errors; // No need to validate further if basic fields are missing
        }

        // Email validation
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL))
            $errors[] = "Invalid email format.";

        // Password length validation
        if (strlen($userData['password']) < 8)
            $errors[] = "Password must be at least 8 characters long.";

        // check if passwords match
        if ($userData['password'] !== $userData['confirmPassword'])
            $errors[] = "Passwords do not match.";

        // Check for existing email in database
        if ($this->getUserByEmail($userData['email']))
            $errors[] = "Email is already taken.";

        return $errors;
    }

    // Logs in a user or returns an array of errors
    public function loginUser(array $credentials): array
    {
        // Validate input data (basic validation)
        if (empty($credentials['email']) || empty($credentials['password']))
            return ["All fields are required."];

        // Attempt to fetch the user by email
        $user = $this->getUserByEmail($credentials['email']);

        if (!$user)
            return ["Invalid email or password."]; // Generic error for security reasons

        // Verify the password
        if (!password_verify($credentials['password'], $user->password))
            return ["Invalid email or password."]; // Generic error for security reasons

        return [];
    }
}

?>