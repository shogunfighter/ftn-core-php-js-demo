<?php

require_once __DIR__ . '/../model/user.model.php';
require_once __DIR__ . '/../controller/user.controller.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $phone_number = $_POST['phone_number'];
    $url = $_POST['url'];

    // Validate form data
    $errors = validateForm($username, $email, $password, $birthdate, $phone_number, $url);

    // If there are no errors, process the form data
    if (count($errors) == 0) {

        $userModel = new UserModel();
        $userController = new UserController($userModel);

        // User data to insert
        $userData = array(
            'username' => $username, // 'john_doe',
            'email' => $email, // 'john@example.com',
            'password' => $password, // 'secret',
            'birthdate' => $birthdate, // '1990-01-01',
            'phone_number' => $phone_number, // '1234567891', // 1111111111
            'url' => $url // 'https://www.example.com'
        );

        // Insert a new user
        $newUser = $userController->createUser($userData);

        // Check if the user was successfully inserted
        if ($newUser) {
            echo 'User inserted successfully!';
        } else {
            echo 'Failed to insert user.';
        }
    } else {
        // Display error messages
        foreach ($errors as $error) {
            echo $error . "\n";
        }
    }
}

// Function to validate form data
function validateForm($username, $email, $password, $birthdate, $phone_number, $url)
{
    $errors = array();

    // username
    if (!preg_match('/^[a-zA-Z]+$/', $username)) {
        $errors[] = "Invalid format [username]: ". $username;
    }

    // email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid format [email]: ". $email;
    }

    // password - 8 chars min, 1 lowercase, 1 uppercase and 1 special sign at least.
    $pw_uppercase = preg_match('@[A-Z]@', $password); // contain at least one uppercase letter
    $pw_lowercase = preg_match('@[a-z]@', $password); // contain at least one lowercase letter
    $pw_number = preg_match('@[0-9]@', $password); // contain at least one digit
    $pw_specialChar = preg_match('@[^\w]@', $password); // contain at least one special character

    if (strlen($password) < 8) {
        $errors[] = "Invalid format [password]: at least 8 characters long";
    } elseif (!$pw_uppercase) {
        $errors[] = "Invalid format [password]: missing 1 uppercase letter";
    } elseif (!$pw_lowercase) {
        $errors[] = "Invalid format [password]: missing 1 lowercase letter";
    } elseif (!$pw_number) {
        $errors[] = "Invalid format [password]: missing 1 digit";
    } elseif (!$pw_specialChar) {
        $errors[] = "Invalid format [password]: missing 1 special sign";
    }

    // if (strlen($password) < 8 || !$pw_uppercase || !$pw_lowercase || !$pw_number || !$pw_specialChar) {
    // $errors[] = "Password must be 8 chars min, 1 lowercase, 1 uppercase and 1 special sign at least.";
    // }

    // birthdate
    $date = DateTime::createFromFormat('Y-m-d', $birthdate);

    $curDate = (new DateTime('now'))->modify('+1 day');
    $curDate = $curDate->format('Y-m-d');
    
    if ($date === false) {
        $errors[] = "Invalid format [birthdate]: " . $birthdate;
    } elseif ($birthdate > $curDate) {
        $errors[] = "Invalid format [birthdate]: birthdate is in the future  " . $birthdate . " " . $curDate . " " . ($date > $curDate);
    }

    // phone number
    if (!preg_match('/^\d{10}$/', $phone_number)) {
        $errors[] = "Invalid format [phone number]: ". $phone_number;
    }

    // url
    if (!preg_match('/^([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/', $url)) {
        $errors[] = "Invalid format [URL]: " . $url;
    }

    return $errors;
}