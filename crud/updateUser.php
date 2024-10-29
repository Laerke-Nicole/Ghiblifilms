<?php
require_once "dbcon.php";

if (isset($_POST['UserID']) && isset($_POST['submit'])) {
    $userName = $_POST['Username'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['PhoneNumber'];
    $address = $_POST['Address'];
    $postalCode = $_POST['PostalCode'];
    $userID = $_POST['UserID'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("UPDATE User SET `Username`='$userName', `FirstName`='$firstName', `LastName`='$lastName', `Email`='$email', `PhoneNumber`='$phoneNumber', `Address`='$address', `PostalCode`='$postalCode' WHERE UserID=$userID");
    $query->execute();

    header("Location: ../index.php?page=admin&status=updated&ID=$userID");
    
} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>
