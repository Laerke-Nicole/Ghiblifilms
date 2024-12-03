<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['RoleInProductionID']) && isset($_POST['submit'])) {
    $nameOfRole = htmlspecialchars(trim($_POST['NameOfRole']));
    $roleInProductionID = htmlspecialchars(trim($_POST['RoleInProductionID']));

    $query = $dbCon->prepare("UPDATE RoleInProduction SET NameOfRole = :nameOfRole WHERE RoleInProductionID = :roleInProductionID");
    
    $query->bindParam(':nameOfRole', $nameOfRole);
    $query->bindParam(':roleInProductionID', $roleInProductionID);
    
    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$roleInProductionID");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>