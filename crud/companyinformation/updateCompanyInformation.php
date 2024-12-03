<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    $companyInformationID = htmlspecialchars($_POST['CompanyInformationID']);
    $nameOfCompany = htmlspecialchars($_POST['NameOfCompany']);
    $companyDescription = htmlspecialchars($_POST['CompanyDescription']);
    $companyEmail = htmlspecialchars($_POST['CompanyEmail']);
    $companyPhoneNumber = htmlspecialchars($_POST['CompanyPhoneNumber']);
    $streetName = htmlspecialchars($_POST['StreetName']);
    $streetNumber = htmlspecialchars($_POST['StreetNumber']);
    $postalCode = htmlspecialchars($_POST['PostalCode']);
    $country = htmlspecialchars($_POST['Country']);
    
    // update company information
    $updateCompany = $dbCon->prepare("UPDATE CompanyInformation SET 
        NameOfCompany = :nameOfCompany, 
        CompanyDescription = :companyDescription, 
        CompanyEmail = :companyEmail, 
        CompanyPhoneNumber = :companyPhoneNumber 
        WHERE CompanyInformationID = :companyInformationID");
    
    $updateCompany->bindParam(':nameOfCompany', $nameOfCompany);
    $updateCompany->bindParam(':companyDescription', $companyDescription);
    $updateCompany->bindParam(':companyEmail', $companyEmail);
    $updateCompany->bindParam(':companyPhoneNumber', $companyPhoneNumber);
    $updateCompany->bindParam(':companyInformationID', $companyInformationID);
    $updateCompany->execute();

    // update address
    $updateAddress = $dbCon->prepare("UPDATE Address SET 
        StreetName = :streetName, 
        StreetNumber = :streetNumber, 
        PostalCode = :postalCode, 
        Country = :country 
        WHERE AddressID = (SELECT AddressID FROM CompanyInformation WHERE CompanyInformationID = :companyInformationID)");
    
    $updateAddress->bindParam(':streetName', $streetName);
    $updateAddress->bindParam(':streetNumber', $streetNumber);
    $updateAddress->bindParam(':postalCode', $postalCode);
    $updateAddress->bindParam(':country', $country);
    $updateAddress->bindParam(':companyInformationID', $companyInformationID); 
    
    $updateAddress->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$companyInformationID");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>
