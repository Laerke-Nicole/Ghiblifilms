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
$recaptchaSecret = '6Le5im4qAAAAAIilBJ35BlmkGIPIjIh-m5LgXR0u';
$recaptchaUrl = 'https://www.google.com/recaptcha/api/siteverify';
$recaptchaValidation = file_get_contents($recaptchaUrl . '?secret=' . $recaptchaSecret . '&response=' . $recaptchaResponse);
$recaptchaData = json_decode($recaptchaValidation);

if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
    echo "No reCAPTCHA token found. Please try again.";
    exit;
}

// Verify reCAPTCHA
if (!$recaptchaData->success) {
    echo "Can't resend contact form. Please try again on the home page.";
    echo '<button class="btn" onclick="window.location.href=\'/ghiblifilms/index.php?page=home\'">Go back to form</button>';
    exit;
}


if (!preg_match($regexp,$_POST['email']))
	  {echo "Email is wrong";
        echo '<button class="btn" onclick="window.location.href=\'/ghiblifilms/index.php?page=home\'">Go back to form</button>';
    }
	  
elseif (empty($firstName) || empty($lastName) || empty($email) || empty($subject) || empty($message))
	{echo "Please fill in all required fields";
    echo '<button class="btn" onclick="window.location.href=\'/ghiblifilms/index.php?page=home\'">Go back to form</button>';
    }

elseif ($_POST['submit'])
{
    $body = "Name: $firstName $lastName\nPhone: $phoneNumber\nEmail: $email\n\nMessage:\n$message";
	mail($mymail,$subject,$body,"From: $email\n");
	echo '<h1>"Thanks for your mail"</h1>';
    echo '<button class="btn" onclick="window.location.href=\'/ghiblifilms/index.php?page=home\'">Go back to front page</button>';
}