<?php

include_once 'conn/journalist.php';

class journalistController extends  journalist
{
    private $authorid;
    private $email;
    private $firstName;
    private $lastName;
    private $password;

    public function __construct($email, $firstName, $lastName, $password)
    {
        $this->authorid = rand(100000, 999999);
        $this->email = $email;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->password = $password;
    }

    public function createJournalist() {
        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->registerJournalist($this->authorid, $this->email, $this->firstName, $this->lastName, $passwordHash);

        header("Location: login.php");
        exit();
    }

    public function getJournalistInfo($email)
    {
        return $this->getJournalistInfoByUsername($email);
    }


}