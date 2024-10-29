<?php
require_once "dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $userName = htmlspecialchars(trim($_POST['Username']));
    $firstName = htmlspecialchars(trim($_POST['FirstName']));
    $lastName = htmlspecialchars(trim($_POST['LastName']));
    $email = htmlspecialchars(trim($_POST['Email']));
    $phoneNumber = htmlspecialchars(trim($_POST['PhoneNumber']));
    $address = htmlspecialchars(trim($_POST['Address']));
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']));

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO User (`Username`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Address`, `PostalCode`) 
    VALUES (:userName, :firstName, :lastName, :email, :phoneNumber, :address, :postalCode)");


    // prepare statements
    $query->bindParam(':userName', $userName);
    $query->bindParam(':firstName', $firstName);
    $query->bindParam(':lastName', $lastName);
    $query->bindParam(':email', $email);
    $query->bindParam(':phoneNumber', $phoneNumber);
    $query->bindParam(':address', $address);
    $query->bindParam(':postalCode', $postalCode);
    $query->execute();

    header("Location: ../index.php?page=admin&status=added");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>
