<?php 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
require_once("includes/functions.php"); 

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
                if (!headers_sent()) {
                    header("Location: /index.php?page=login");
                    exit;
                } else {
                    echo "<script>window.location.href='/index.php?page=login';</script>";
                    exit;
                }
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