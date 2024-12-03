<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['VoiceActorID']) && isset($_POST['submit'])) {
    $firstname = htmlspecialchars(trim($_POST['FirstName']));
    $lastname = htmlspecialchars(trim($_POST['LastName']));
    $voiceActorID = htmlspecialchars(trim($_POST['VoiceActorID']));

    $query = $dbCon->prepare("UPDATE VoiceActor SET FirstName = :firstname, LastName = :lastName WHERE VoiceActorID = :voiceActorID");
    
    $query->bindParam(':firstname', $firstname);
    $query->bindParam(':lastName', $lastname);
    $query->bindParam(':voiceActorID', $voiceActorID);
    
    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&ID=$voiceActorID");
    
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>