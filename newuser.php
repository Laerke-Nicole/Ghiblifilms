<?php 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
require_once("includes/functions.php"); 

// // recaptcha
// $recaptchaSecret = '6Le5im4qAAAAAIilBJ35BlmkGIPIjIh-m5LgXR0u';
// $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

// if (!$recaptchaResponse) {
//     echo "reCAPTCHA token is missing. Please try again.";
//     exit;
// }

// $recaptchaValidation = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
// $recaptchaData = json_decode($recaptchaValidation);

// if (!$recaptchaData || !$recaptchaData->success) {
//     echo "Can't create user. reCAPTCHA validation failed. Please try again.";
//     echo '<button class="btn" onclick="window.location.href=\'/ghiblifilms/index.php?page=newuser\'">Go back to form</button>';
//     exit;
// }


if (isset($_POST['submit'])) {

	$username = htmlspecialchars(trim($_POST['Username']));
	$password = htmlspecialchars(trim($_POST['Pass']));
    $firstName = htmlspecialchars(trim($_POST['FirstName']));
    $lastName = htmlspecialchars(trim($_POST['LastName']));
    $email = htmlspecialchars(trim($_POST['Email']));
    $phoneNumber = htmlspecialchars(trim($_POST['PhoneNumber']));
    $streetName = htmlspecialchars(trim($_POST['StreetName']));
    $streetNumber = htmlspecialchars(trim($_POST['StreetNumber']));
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']));
    $country = htmlspecialchars(trim($_POST['Country']));

    // check if username already exists
    $query = "SELECT COUNT(*) FROM User WHERE Username = :username";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
	
    // fetch the count of usernames found
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // if username already exists
        $message = "The username '{$username}' is taken. Please choose a different username.";
    } else {

        // hash the password
        $iterations = ['cost' => 15];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

        try {
            // first insert the address
            $queryAddress = $connection->prepare("INSERT INTO Address (StreetName, StreetNumber, PostalCode, Country) 
                                            VALUES (:streetName, :streetNumber, :postalCode, :country)");
            $queryAddress->bindParam(':streetName', $streetName);
            $queryAddress->bindParam(':streetNumber', $streetNumber);
            $queryAddress->bindParam(':postalCode', $postalCode);
            $queryAddress->bindParam(':country', $country);
            $queryAddress->execute();

            // get the last inserted AddressID
            $addressID = $connection->lastInsertId();


            $query = "INSERT INTO User (Username, Pass, FirstName, LastName, Email, PhoneNumber, AddressID) VALUES (:username, :hashed_password, :firstName, :lastName, :email, :phoneNumber, :addressID)";
            $stmt = $connection->prepare($query);

            // bind parameters
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':hashed_password', $hashed_password);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $stmt->bindParam(':addressID', $addressID);

            $result = $stmt->execute();

            if ($result) {
                $message = "User Created.";
                redirect_to("index.php?page=login");
            } else {
                $message = "User could not be created.";
            }
        } catch (PDOException $e) {
            $message = "User could not be created. Error: " . $e->getMessage();
        }
    }
}

// display the message if set
if (!empty($message)) {
    echo "<p>" . $message . "</p>";
}

// display the new user form
include ("views/newUserDetail.php");

// close the connection
if (isset($connection)){$connection = null;} 
?>