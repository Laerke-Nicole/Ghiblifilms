<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['GenreID']) && isset($_POST['submit'])) {
    $genreName = htmlspecialchars(trim($_POST['GenreName']));
    $genreID = htmlspecialchars(trim($_POST['GenreID']));

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("UPDATE Genre SET GenreName = :genreName WHERE GenreID = :genreID");
    
    $query->bindParam(':genreName', $genreName);
    $query->bindParam(':genreID', $genreID);
    
    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$genreID");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>