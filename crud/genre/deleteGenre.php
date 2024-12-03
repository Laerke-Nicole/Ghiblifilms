<?php
require_once "includes/dbcon.php";

if (isset($_GET['GenreID'])) {
    $genreID = $_GET['GenreID'];

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM Genre WHERE GenreID = :genreID");
    
    // Bind the parameter
    $query->bindParam(':genreID', $genreID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ID=$genreID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>