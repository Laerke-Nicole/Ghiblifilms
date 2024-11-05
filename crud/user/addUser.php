<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $firstName = htmlspecialchars(trim($_POST['FirstName']));
    $lastName = htmlspecialchars(trim($_POST['LastName']));
    $email = htmlspecialchars(trim($_POST['Email']));
    $phoneNumber = htmlspecialchars(trim($_POST['PhoneNumber']));
    $streetName = htmlspecialchars(trim($_POST['StreetName']));
    $streetNumber = htmlspecialchars(trim($_POST['StreetNumber']));
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']));
    $country = htmlspecialchars(trim($_POST['Country']));

    $dbCon = dbCon($user, $pass);

    // First insert the address
    $queryAddress = $dbCon->prepare("INSERT INTO Address (StreetName, StreetNumber, PostalCode, Country) 
                                      VALUES (:streetName, :streetNumber, :postalCode, :country)");
    $queryAddress->bindParam(':streetName', $streetName);
    $queryAddress->bindParam(':streetNumber', $streetNumber);
    $queryAddress->bindParam(':postalCode', $postalCode);
    $queryAddress->bindParam(':country', $country);
    $queryAddress->execute();

    // Get the last inserted AddressID
    $addressID = $dbCon->lastInsertId();
    

    // Now insert the user
    $queryUser = $dbCon->prepare("INSERT INTO User (FirstName, LastName, Email, PhoneNumber, AddressID) 
    VALUES (:firstName, :lastName, :email, :phoneNumber, :addressID)");

    $queryUser->bindParam(':firstName', $firstName);
    $queryUser->bindParam(':lastName', $lastName);
    $queryUser->bindParam(':email', $email);
    $queryUser->bindParam(':phoneNumber', $phoneNumber);
    $queryUser->bindParam(':addressID', $addressID);
    $queryUser->execute();

    header("Location: ../../index.php?page=admin&status=added");

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>
