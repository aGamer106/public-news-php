<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_on'])) {
    header("Location: index.php");
    exit();
}


require_once 'conn/user.php';
require_once 'controller/userController.php';
$user = new userController();

if (isset($_POST['submit'])) {
    $user->getSubscription($_SESSION['email']);
}

//require_once 'components/navbar.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Purchase Membership</title>
    <link rel="stylesheet" href="design/pay.css">
</head>
<body>
<div class="container">

    <div class="card-container">

        <div class="front">
            <div class="image">
                <img src="design/backgrounds/chip.png" alt="">
                <img src="design/backgrounds/visa.png" alt="">
            </div>
            <div class="card-number-box">################</div>
            <div class="flexbox">
                <div class="box">
                    <span>card holder</span>
                    <div class="card-holder-name">full name</div>
                </div>
                <div class="box">
                    <span>expires</span>
                    <div class="expiration">
                        <span class="exp-month">mm</span>
                        <span class="exp-year">yy</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="back">
            <div class="stripe"></div>
            <div class="box">
                <span>cvv</span>
                <div class="cvv-box"></div>
                <img src="design/backgrounds/visa.png" alt="">
            </div>
        </div>

    </div>

    <form method="post">
        <div class="inputBox">
            <span>card number</span>
            <input type="text" name="card_number" maxlength="16" class="card-number-input">
        </div>
        <div class="inputBox">
            <span>card holder</span>
            <input type="text" name="card_holder" class="card-holder-input">
        </div>
        <div class="flexbox">
            <div class="inputBox">
                <span>expiration mm</span>
                <select name="expiration_month" id="" class="month-input">
                    <option value="month" selected disabled>month</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
            </div>
            <div class="inputBox">
                <span>expiration yy</span>
                <select name="expiration_year" id="" class="year-input">
                    <option value="year" selected disabled>year</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                    <option value="2027">2027</option>
                    <option value="2028">2028</option>
                    <option value="2029">2029</option>
                    <option value="2030">2030</option>
                </select>
            </div>
            <div class="inputBox">
                <span>cvv</span>
                <input name="cvv" type="text" maxlength="4" class="cvv-input">
            </div>
        </div>
        <input type="submit" value="submit" class="submit-btn" name="submit">
    <?php

    //other code here
    $valid_cards = array(
        "1234567890123456",
        "2345678901234567",
        "3456789012345678",
        "1234123412341234"
    );

    if (isset($_POST["submit"])) {
        $card_number = $_POST["card_number"];
        if (in_array($card_number, $valid_cards)) {
            $card_holder = $_POST["card_holder"];
            $expiration_month = $_POST["expiration_month"];
            $expiration_year = $_POST["expiration_year"];
            $cvv = $_POST["cvv"];

            //check if the card is valid in a fake way
            if (strlen($card_number) == 16 &&
                preg_match("/^[a-zA-Z ]+$/", $card_holder) &&
                checkdate($expiration_month, 1, $expiration_year) &&
                strlen($cvv) == 3) {
//                $payment_result = "success";

                header("Location: paymentResult.php?payment_result=success");
            } } else {
//            $payment_result = "failure";
            header("Location: paymentResult.php?payment_result=failure");
        }
    }
    ?>

        <script>

            document.querySelector('.card-number-input').oninput = () =>{
                document.querySelector('.card-number-box').innerText = document.querySelector('.card-number-input').value;
            }

            document.querySelector('.card-holder-input').oninput = () =>{
                document.querySelector('.card-holder-name').innerText = document.querySelector('.card-holder-input').value;
            }

            document.querySelector('.month-input').oninput = () =>{
                document.querySelector('.exp-month').innerText = document.querySelector('.month-input').value;
            }

            document.querySelector('.year-input').oninput = () =>{
                document.querySelector('.exp-year').innerText = document.querySelector('.year-input').value;
            }

            document.querySelector('.cvv-input').onmouseenter = () =>{
                document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(-180deg)';
                document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(0deg)';
            }

            document.querySelector('.cvv-input').onmouseleave = () =>{
                document.querySelector('.front').style.transform = 'perspective(1000px) rotateY(0deg)';
                document.querySelector('.back').style.transform = 'perspective(1000px) rotateY(180deg)';
            }

            document.querySelector('.cvv-input').oninput = () =>{
                document.querySelector('.cvv-box').innerText = document.querySelector('.cvv-input').value;
            }

        </script>
