<?php
// mail to send to
$myMail = "laerke@laerkenicole.dk";

// the inputs from the form
$firstName = htmlspecialchars(trim($_POST['firstName']));
$lastName = htmlspecialchars(trim($_POST['lastName']));
$email = htmlspecialchars(trim($_POST['email']));
$msg = htmlspecialchars(trim($_POST['message']));
// the numbers and letters that are allowed in the email
$regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";

// token
$recaptchaResponse = $_POST['g-recaptcha-response'];

// check reCAPTCHA
include ("secretKey.php");
$recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

// if no token is found
if (empty($recaptchaResponse)) {
    echo "No reCAPTCHA token found. Please try again.";
    exit;
}

// get reCAPTCHA secret key
$recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
$recaptchaValidation = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
$recaptchaData = json_decode($recaptchaValidation);

// verify reCAPTCHA
if (!$recaptchaData->success) {
    header("Location: /index.php?page=home");
    exit;
}

// if the email is valid
if (!preg_match($regexp,$_POST['email'])) {
        echo "Email is wrong";
        echo '<a href="/index.php?page=home" class="btn">Go back to home page</a>';
    }
	  
// if the fields are empty
elseif (empty($firstName) || empty($lastName) || empty($email) || empty($msg)) {
        echo "Please fill in all required fields";
        echo '<a href="/index.php?page=home" class="btn">Go back to home page</a>';
    }

// send email
elseif (($_POST['submit'])) {
    $body = "$msg \n\n Name: $firstName $lastName \n Email: $email";
        mail($myMail,$body,"From: $email\n");
        echo '<h1>"Thanks for your mail"</h1>';
        echo '<a href="/index.php?page=home" class="btn">Go back to home page</a>';
    }