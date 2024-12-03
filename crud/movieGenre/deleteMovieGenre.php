<?php
require_once "includes/dbcon.php";

if (isset($_GET['MovieID']) && isset($_GET['GenreID'])) {
    $movieID = $_GET['MovieID'];
    $genreID = $_GET['GenreID'];

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM MovieGenre WHERE MovieID = :movieID AND GenreID = :genreID");
    
    // Bind the parameter
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':genreID', $genreID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&MovieID=$movieID&GenreID=$genreID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>