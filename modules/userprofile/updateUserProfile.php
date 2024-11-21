<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    $userID = htmlspecialchars($_POST['UserID']);
    $username = htmlspecialchars($_POST['Username']);
    $firstName = htmlspecialchars($_POST['FirstName']);
    $lastName = htmlspecialchars($_POST['LastName']);
    $email = htmlspecialchars($_POST['Email']);
    $phoneNumber = htmlspecialchars($_POST['PhoneNumber']);
    $streetName = htmlspecialchars($_POST['StreetName']);
    $streetNumber = htmlspecialchars($_POST['StreetNumber']);
    $postalCode = htmlspecialchars($_POST['PostalCode']);
    $country = htmlspecialchars($_POST['Country']);

    $dbCon = dbCon($user, $pass);
    
    // update user info
    $updateUser = $dbCon->prepare("UPDATE User SET Username = :username, FirstName = :firstName, LastName = :lastName, Email = :email, PhoneNumber = :phoneNumber WHERE UserID = :userID");
    $updateUser->bindParam(':username', $username);
    $updateUser->bindParam(':firstName', $firstName);
    $updateUser->bindParam(':lastName', $lastName);
    $updateUser->bindParam(':email', $email);
    $updateUser->bindParam(':phoneNumber', $phoneNumber);
    $updateUser->bindParam(':userID', $userID);
    $updateUser->execute();

    // update address
    $updateAddress = $dbCon->prepare("UPDATE Address SET StreetName = :streetName, StreetNumber = :streetNumber, PostalCode = :postalCode, Country = :country WHERE AddressID = (SELECT AddressID FROM User WHERE UserID = :userID)");
    $updateAddress->bindParam(':streetName', $streetName);
    $updateAddress->bindParam(':streetNumber', $streetNumber);
    $updateAddress->bindParam(':postalCode', $postalCode);
    $updateAddress->bindParam(':country', $country);
    $updateAddress->bindParam(':userID', $userID);
    
    $updateAddress->execute();

    header("Location: ../../index.php?page=userprofile&status=updated&UserID=$userID");
    
} else {
    header("Location: ../../index.php?page=userprofile&status=0");
}
?>