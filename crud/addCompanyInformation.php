<?php
require_once "dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $nameOfCompany = htmlspecialchars(trim($_POST['NameOfCompany']));
    $companyDescription = htmlspecialchars(trim($_POST['CompanyDescription']));
    $companyEmail = htmlspecialchars(trim($_POST['CompanyEmail']));
    $companyPhoneNumber = htmlspecialchars(trim($_POST['CompanyPhoneNumber']));
    $addressOfCompany = htmlspecialchars(trim($_POST['AddressOfCompany']));
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']));

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("INSERT INTO CompanyInformation (NameOfCompany, CompanyDescription, CompanyEmail, CompanyPhoneNumber, AddressOfCompany, PostalCode) 
    VALUES (:nameOfCompany, :companyDescription, :companyEmail, :companyPhoneNumber, :addressOfCompany, :postalCode)");


    // prepare statements
    $query->bindParam(':nameOfCompany', $nameOfCompany);
    $query->bindParam(':companyDescription', $companyDescription);
    $query->bindParam(':companyEmail', $companyEmail);
    $query->bindParam(':companyPhoneNumber', $companyPhoneNumber);
    $query->bindParam(':addressOfCompany', $addressOfCompany);
    $query->bindParam(':postalCode', $postalCode);
    $query->execute();

    header("Location: ../index.php?page=admin&status=added");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>