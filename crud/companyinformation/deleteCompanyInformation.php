<?php
require_once "includes/dbcon.php";

if (isset($_GET['CompanyInformationID'])) {
    $companyInformationID = $_GET['CompanyInformationID'];

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("DELETE FROM CompanyInformation WHERE CompanyInformationID=$companyInformationID");
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ID=$companyInformationID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>