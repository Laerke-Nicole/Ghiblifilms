<?php
require_once "dbcon.php";

if (isset($_POST['CompanyInformationID']) && isset($_POST['submit'])) {
    $nameOfCompany = $_POST['NameOfCompany'];
    $companyDescription = $_POST['CompanyDescription'];
    $companyEmail = $_POST['CompanyEmail'];
    $companyPhoneNumber = $_POST['CompanyPhoneNumber'];
    $addressOfCompany = $_POST['AddressOfCompany'];
    $postalCode = $_POST['PostalCode'];
    $companyInformationID = $_POST['CompanyInformationID'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("UPDATE CompanyInformation SET `NameOfCompany`='$nameOfCompany', `CompanyDescription`='$companyDescription', `CompanyEmail`='$companyEmail', `CompanyPhoneNumber`='$companyPhoneNumber', `AddressOfCompany`='$addressOfCompany', `PostalCode`='$postalCode' WHERE CompanyInformationID=$companyInformationID");
    $query->execute();
    
    header("Location: admin.php?status=updated&ID=$companyInformationID");

} else {
    header("Location: admin.php?status=0");
}
?>
