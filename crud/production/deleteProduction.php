<?php
require_once "includes/dbcon.php";

if (isset($_GET['ProductionID'])) {
    $productionID = $_GET['ProductionID'];

    $dbCon = dbCon($user, $pass);

    // First delete the role in production that is linked to the production
    $deleteProductionQuery = $dbCon->prepare("DELETE FROM Production WHERE ProductionID = :productionID");
    $deleteProductionQuery->bindParam(':productionID', $productionID);
    $deleteProductionQuery->execute();

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM Production WHERE ProductionID = :productionID");
    
    // Bind the parameter
    $query->bindParam(':productionID', $productionID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ID=$productionID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>