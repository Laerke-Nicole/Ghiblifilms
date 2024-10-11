<?php
require_once "dbcon.php";

if (isset($_POST['submit'])) {
    $userName = $_POST['Username'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['PhoneNumber'];
    $address = $_POST['Address'];
    $postalCode = $_POST['PostalCode'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO User (`Username`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Address`, `PostalCode`) VALUES ('$userName', '$firstName', '$lastName', '$email', '$phoneNumber', '$address', '$postalCode')");
    $query->execute();

    header("Location: admin.php?status=added");

} else {
    header("Location: admin.php?status=0");
}
?>
