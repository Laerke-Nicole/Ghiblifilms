<?php
require_once "includes/dbcon.php";

if (isset($_GET['VoiceActorID'])) {
    $voiceActorID = $_GET['VoiceActorID'];

    $dbCon = dbCon($user, $pass);

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM VoiceActor WHERE VoiceActorID = :voiceActorID");
    
    // Bind the parameter
    $query->bindParam(':voiceActorID', $voiceActorID);
    
    $query->execute();

    header("Location: index.php?page=admin&status=deleted&VoiceActorID=$voiceActorID");

} else {
    header("Location: index.php?page=admin&status=0");
}
?>