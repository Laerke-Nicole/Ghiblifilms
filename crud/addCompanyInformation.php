<?php
require_once "dbcon.php";

if (isset($_POST['submit'])) {
    $nameOfCompany = $_POST['NameOfCompany'];
    $companyDescription = $_POST['CompanyDescription'];
    $companyEmail = $_POST['CompanyEmail'];
    $companyPhoneNumber = $_POST['CompanyPhoneNumber'];
    $addressOfCompany = $_POST['AddressOfCompany'];
    $postalCode = $_POST['PostalCode'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO CompanyInformation (`NameOfCompany`, `CompanyDescription`, `CompanyEmail`, `CompanyPhoneNumber`, `AddressOfCompany`, `PostalCode`) VALUES ('$nameOfCompany', '$companyDescription', '$companyEmail', '$companyPhoneNumber', '$addressOfCompany', '$postalCode')");
    $query->execute();

    header("Location: ../index.php?page=admin&status=added");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>