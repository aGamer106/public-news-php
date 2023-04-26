<?php
include_once 'conn/login.php';


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
        if (!password_verify($this->password, $result['password'])) {
            $_SESSION['error'] = 'Username or password is wrong';
            header('location: login.php');
            exit();
        }
        // If all checks pass, set the logged_on and first_name session variables and return true
        $_SESSION['logged_on'] = true;
        $_SESSION['first_name'] = $result['first_name'];

        switch ($result['user_type']) {
            case 'user':
                // Redirect to user home page
//                header('Location: user_home.php');
                header('Location: login_success.php');
                break;
            case 'journalist':
                // Redirect to journalist home page
//                header('Location: journalist_home.php');
                header('Location: login_success.php');
                break;
            case 'admin':
                // Redirect to admin home page
//                header('Location: admin_home.php');
                header('Location: login_success.php');
                break;
            default:
                // If the user role is not recognized, redirect to login page
                header('Location: login.php');
                break;
        }

        header('Location: login_success.php');
        exit();

    }

}
