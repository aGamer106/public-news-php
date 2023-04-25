<?php
include_once 'login.php';


class loginController extends login
{
    private $email;
    private $password;

    public function __construct($email, $password)
    {
        $this->email = strtolower($email);
        $this->password = $password;
    }

    public function login()
    {
        // Get user login information
        $result = $this->getUserInfoByUsername($this->email);

        // Check all fields are filled
        if (empty($this->email) || empty($this->password)) {
            $_SESSION['error'] = 'Please make sure all fields are filled';
            return false;
        }

        // Verify that user exists
        if ($result['email'] != $this->email) {
            $_SESSION['error'] = 'Username or password is wrong';
            return false;
        }

        // Verify password matches
        $hashed_password = hash('sha256', $this->password . $result['salt']);
        if ($hashed_password != $result['password']) {
            $_SESSION['error'] = 'Username or password is wrong';
            return false;
        }

        // If all checks pass, set the logged_on session variable and return true
        $_SESSION['logged_on'] = true;
        return true;
    }

}
