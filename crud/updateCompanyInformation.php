<?php
require_once "dbcon.php";

if (isset($_POST['CompanyInformationID']) && isset($_POST['submit'])) {
    $nameOfCompany = htmlspecialchars(trim($_POST['NameOfCompany']));
    $companyDescription = htmlspecialchars(trim($_POST['CompanyDescription']));
    $companyEmail = htmlspecialchars(trim($_POST['CompanyEmail']));
    $companyPhoneNumber = htmlspecialchars(trim($_POST['CompanyPhoneNumber']));
    $addressOfCompany = htmlspecialchars(trim($_POST['AddressOfCompany']));
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']));
    $companyInformationID = htmlspecialchars(trim($_POST['CompanyInformationID']));

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("UPDATE CompanyInformation SET 
        `NameOfCompany` = :nameOfCompany, 
        `CompanyDescription` = :companyDescription, 
        `CompanyEmail` = :companyEmail, 
        `CompanyPhoneNumber` = :companyPhoneNumber, 
        `AddressOfCompany` = :addressOfCompany, 
        `PostalCode` = :postalCode 
        WHERE CompanyInformationID = :companyInformationID");

    $query->bindParam(':nameOfCompany', $nameOfCompany);
    $query->bindParam(':companyDescription', $companyDescription);
    $query->bindParam(':companyEmail', $companyEmail);
    $query->bindParam(':companyPhoneNumber', $companyPhoneNumber);
    $query->bindParam(':addressOfCompany', $addressOfCompany);
    $query->bindParam(':postalCode', $postalCode);
    $query->bindParam(':companyInformationID', $companyInformationID, PDO::PARAM_INT);

    $query->execute();
    
    header("Location: ../index.php?page=admin&status=updated&ID=$companyInformationID");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>
