<?php
require_once "includes/dbcon.php";

if (isset($_GET['OpeningHourID'])) {
    $openingHourID = $_GET['OpeningHourID'];

    $dbCon = dbCon($user, $pass);

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM OpeningHour WHERE OpeningHourID = :openingHourID");
    
    // Bind the parameter
    $query->bindParam(':openingHourID', $openingHourID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ID=$openingHourID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>