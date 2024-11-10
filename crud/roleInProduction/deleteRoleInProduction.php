<?php
require_once "includes/dbcon.php";

if (isset($_GET['RoleInProductionID'])) {
    $roleInProductionID = $_GET['RoleInProductionID'];

    $dbCon = dbCon($user, $pass);

    // First delete the role in production that is linked to the production
    $deleteProductionQuery = $dbCon->prepare("DELETE FROM Production WHERE RoleInProductionID = :roleInProductionID");
    $deleteProductionQuery->bindParam(':roleInProductionID', $roleInProductionID);
    $deleteProductionQuery->execute();

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM RoleInProduction WHERE RoleInProductionID = :roleInProductionID");
    
    // Bind the parameter
    $query->bindParam(':roleInProductionID', $roleInProductionID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ID=$roleInProductionID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>