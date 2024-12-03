<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['ProductionID']) && isset($_POST['submit'])) {
    $firstname = htmlspecialchars(trim($_POST['FirstName']));
    $lastname = htmlspecialchars(trim($_POST['LastName']));
    $roleInProductionID = htmlspecialchars(trim($_POST['RoleInProductionID']));
    $productionID = htmlspecialchars(trim($_POST['ProductionID']));

    $query = $dbCon->prepare("UPDATE Production SET FirstName = :firstname, LastName = :lastName, RoleInProductionID = :roleInProductionID WHERE ProductionID = :productionID");
    
    $query->bindParam(':firstname', $firstname);
    $query->bindParam(':lastName', $lastname);
    $query->bindParam(':roleInProductionID', $roleInProductionID);
    $query->bindParam(':productionID', $productionID);
    
    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$productionID");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>