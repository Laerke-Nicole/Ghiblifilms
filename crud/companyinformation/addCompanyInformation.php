<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $nameOfCompany = htmlspecialchars(trim($_POST['NameOfCompany']), ENT_QUOTES, 'UTF-8');
    $companyDescription = htmlspecialchars(trim($_POST['CompanyDescription']), ENT_QUOTES, 'UTF-8');
    $companyEmail = htmlspecialchars(trim($_POST['CompanyEmail']), ENT_QUOTES, 'UTF-8');
    $companyPhoneNumber = htmlspecialchars(trim($_POST['CompanyPhoneNumber']), ENT_QUOTES, 'UTF-8');
    $address = htmlspecialchars(trim($_POST['Address']), ENT_QUOTES, 'UTF-8');
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("INSERT INTO CompanyInformation (NameOfCompany, CompanyDescription, CompanyEmail, CompanyPhoneNumber, Address, PostalCode) 
    VALUES (:nameOfCompany, :companyDescription, :companyEmail, :companyPhoneNumber, :address, :postalCode)");


    // prepare statements
    $query->bindParam(':nameOfCompany', $nameOfCompany);
    $query->bindParam(':companyDescription', $companyDescription);
    $query->bindParam(':companyEmail', $companyEmail);
    $query->bindParam(':companyPhoneNumber', $companyPhoneNumber);
    $query->bindParam(':address', $address);
    $query->bindParam(':postalCode', $postalCode);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>