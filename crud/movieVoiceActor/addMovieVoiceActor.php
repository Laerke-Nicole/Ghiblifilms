<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $voiceActorID = htmlspecialchars(trim($_POST['VoiceActorID']));

    $query = $dbCon->prepare("INSERT INTO MovieVoiceActor (MovieID, VoiceActorID) VALUES (:movieID, :voiceActorID)");

    // Prepare statements
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':voiceActorID', $voiceActorID);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>