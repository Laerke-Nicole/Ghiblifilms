<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $productionID = htmlspecialchars(trim($_POST['ProductionID']));

    $query = $dbCon->prepare("INSERT INTO MovieProduction (MovieID, ProductionID) VALUES (:movieID, :productionID)");

    // Prepare statements
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':productionID', $productionID);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>