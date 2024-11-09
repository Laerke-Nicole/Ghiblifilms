<?php
require_once "includes/dbcon.php";

if (isset($_GET['MovieID']) && isset($_GET['ProductionID'])) {
    $movieID = $_GET['MovieID'];
    $productionID = $_GET['ProductionID'];

    $dbCon = dbCon($user, $pass);

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM MovieProduction WHERE MovieID = :movieID AND ProductionID = :productionID");
    
    // Bind the parameter
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':productionID', $productionID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&MovieID=$movieID&ProductionID=$productionID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>