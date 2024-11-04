<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $firstName = htmlspecialchars(trim($_POST['FirstName']), ENT_QUOTES, 'UTF-8');
    $lastName = htmlspecialchars(trim($_POST['LastName']), ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars(trim($_POST['Email']), ENT_QUOTES, 'UTF-8');
    $phoneNumber = htmlspecialchars(trim($_POST['PhoneNumber']), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['Address']), ENT_QUOTES, 'UTF-8');
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO User (`FirstName`, `LastName`, `Email`, `PhoneNumber`, `Address`, `PostalCode`) 
    VALUES (:firstName, :lastName, :email, :phoneNumber, :address, :postalCode)");


    // prepare statements
    $query->bindParam(':firstName', $firstName);
    $query->bindParam(':lastName', $lastName);
    $query->bindParam(':email', $email);
    $query->bindParam(':phoneNumber', $phoneNumber);
    $query->bindParam(':address', $address);
    $query->bindParam(':postalCode', $postalCode);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>