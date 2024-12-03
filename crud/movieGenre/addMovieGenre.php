<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $genreID = htmlspecialchars(trim($_POST['GenreID']));

    $query = $dbCon->prepare("INSERT INTO MovieGenre (MovieID, GenreID) VALUES (:movieID, :genreID)");

    // Prepare statements
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':genreID', $genreID);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>