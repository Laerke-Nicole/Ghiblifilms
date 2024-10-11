<?php
require_once "dbcon.php";

if (isset($_GET['CompanyInformationID'])) {
    $companyInformationID = $_GET['CompanyInformationID'];
    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("DELETE FROM CompanyInformation WHERE CompanyInformationID=$companyInformationID");
    $query->execute();

    header("Location: admin.php?status=deleted&ID=$companyInformationID");
} else {
    header("Location: admin.php?status=0");
}
?>



