<?php
require_once "includes/dbcon.php";

if (isset($_GET['MovieID']) && isset($_GET['VoiceActorID'])) {
    $movieID = $_GET['MovieID'];
    $voiceActorID = $_GET['VoiceActorID'];

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM MovieVoiceActor WHERE MovieID = :movieID AND VoiceActorID = :voiceActorID");
    
    // Bind the parameter
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':voiceActorID', $voiceActorID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&MovieID=$movieID&VoiceActorID=$voiceActorID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>