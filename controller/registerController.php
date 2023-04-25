<?php
include_once 'conn/register.php';

class registerController extends register
{
    private $userid;
    private $email;
    private $firstName;
    private $lastName;
    private $password;

    public function __construct($email, $firstName, $lastName, $password)
    {
        $this->userid = rand(1000, 9999);
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
    }

    public function register()
    {
        // Get user register information if any
        $result = $this->getUserInfoByUsername($this->email);

        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->registerUser($this->userid, $this->email, $this->firstName, $this->lastName, $passwordHash);

        // Redirect if successful
        header('Location: login.php');
        exit();
    }
}
