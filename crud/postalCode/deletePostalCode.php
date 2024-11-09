<?php
require_once "includes/dbcon.php";

if (isset($_GET['PostalCode'])) {
    $postalCode = $_GET['PostalCode'];

    $dbCon = dbCon($user, $pass);

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM PostalCode WHERE PostalCode = :postalCode");
    
    // Bind the parameter
    $query->bindParam(':postalCode', $postalCode);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ID=$postalCode");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>