<?php
require_once "includes/dbcon.php";

if (isset($_GET['MovieID'])) {
    $movieID = htmlspecialchars(trim($_GET['MovieID']));

    $dbCon = dbCon($user, $pass);

    // Delete related entries in moviegenre
    $queryDeleteGenre = $dbCon->prepare("DELETE FROM moviegenre WHERE MovieID = :movieID");
    $queryDeleteGenre->bindParam(':movieID', $movieID, PDO::PARAM_INT);
    $queryDeleteGenre->execute();

    // Delete related entries in movieproduction
    $queryDeleteProduction = $dbCon->prepare("DELETE FROM movieproduction WHERE MovieID = :movieID");
    $queryDeleteProduction->bindParam(':movieID', $movieID, PDO::PARAM_INT);
    $queryDeleteProduction->execute();

    // Delete related entries in movievoiceactor
    $queryDeleteVoiceActor = $dbCon->prepare("DELETE FROM movievoiceactor WHERE MovieID = :movieID");
    $queryDeleteVoiceActor->bindParam(':movieID', $movieID, PDO::PARAM_INT);
    $queryDeleteVoiceActor->execute();

    // Finally, delete the movie itself
    $query = $dbCon->prepare("DELETE FROM Movie WHERE MovieID = :movieID");
    $query->bindParam(':movieID', $movieID, PDO::PARAM_INT);
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&ID=$movieID");
} else {
    header("Location: index.php?page=admin&status=0");
}
?>