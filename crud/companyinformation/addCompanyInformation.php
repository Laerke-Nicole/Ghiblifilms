<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $nameOfCompany = htmlspecialchars(trim($_POST['NameOfCompany']));
    $companyDescription = htmlspecialchars(trim($_POST['CompanyDescription']));
    $companyEmail = htmlspecialchars(trim($_POST['CompanyEmail']));
    $companyPhoneNumber = htmlspecialchars(trim($_POST['CompanyPhoneNumber']));
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
    

    $query = $dbCon->prepare("INSERT INTO CompanyInformation (NameOfCompany, CompanyDescription, CompanyEmail, CompanyPhoneNumber, AddressID) 
    VALUES (:nameOfCompany, :companyDescription, :companyEmail, :companyPhoneNumber, :addressID)");


    // prepare statements
    $query->bindParam(':nameOfCompany', $nameOfCompany);
    $query->bindParam(':companyDescription', $companyDescription);
    $query->bindParam(':companyEmail', $companyEmail);
    $query->bindParam(':companyPhoneNumber', $companyPhoneNumber);
    $query->bindParam(':addressID', $addressID);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>