<?php

include_once 'conn/user.php';

class userController extends user
{
    public function update($email, $password)
    {
        // Get user detail
        $result = $this->getUserByID($_SESSION['userID']);

        // Check all field are filled
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Please make sure all field are filled';
            header('location: profile.php');
            exit();
        }

        // Verify the email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'Invalid email address';
            header('location: profile.php');
            exit();
        }

        // Verify password matches
        if (!password_verify($password, $result['password'])) {
            $_SESSION['error'] = 'Incorrect password';
            header('location: profile.php');
            exit();
        }

        // Update user information
        $this->updateMyProfile($email);
    }
}