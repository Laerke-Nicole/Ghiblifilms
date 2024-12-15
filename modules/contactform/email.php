<?php
$mymail = "laerke@laerkenicole.dk";

$firstName = htmlspecialchars(trim($_POST['firstName']));
$lastName = htmlspecialchars(trim($_POST['lastName']));
$email = htmlspecialchars(trim($_POST['email']));
$phoneNumber = htmlspecialchars(trim($_POST['phoneNumber']));
$subject = htmlspecialchars(trim($_POST['subject']));
$message = htmlspecialchars(trim($_POST['message']));
$regexp = "/^[^0-9][A-z0-9_-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_-]+)*[.][A-z]{2,4}$/";

// token
$recaptchaResponse = $_POST['g-recaptcha-response'];

// Check reCAPTCHA
include ("secretKey.php");
$recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
$recaptchaValidation = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
$recaptchaData = json_decode($recaptchaValidation);

if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
    echo "No reCAPTCHA token found. Please try again.";
    exit;
}

// verify reCAPTCHA
if (!$recaptchaData->success) {
    header("Location: /index.php?page=home");
    exit;
}

// if the email is valid
if (!preg_match($regexp,$_POST['email']))
	  {echo "Email is wrong";
        echo '<a href="/index.php?page=home" class="btn">Go back to home page</a>';
    }
	  
// if the fields are empty
elseif (empty($firstName) || empty($lastName) || empty($email) || empty($subject) || empty($message))
	{echo "Please fill in all required fields";
        echo '<a href="/index.php?page=home" class="btn">Go back to home page</a>';
    }

// successful email
elseif ($_POST['submit'])
{
    $body = "Name: $firstName $lastName\nPhone: $phoneNumber\nEmail: $email\n\nMessage:\n$message";
	mail($mymail,$subject,$body,"From: $email\n");
	echo '<h1>"Thanks for your mail"</h1>';
    echo '<a href="/index.php?page=home" class="btn">Go back to home page</a>';
}