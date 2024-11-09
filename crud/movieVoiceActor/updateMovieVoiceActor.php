<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['MovieID']) && isset($_POST['VoiceActorID']) && isset($_POST['originalMovieID']) && isset($_POST['originalVoiceActorID']) && isset($_POST['submit'])) {
    // get the new values from the form on editMovieProduction.php
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $voiceActorID = htmlspecialchars(trim($_POST['VoiceActorID']));
    
    // get the first values to identify the record
    $originalMovieID = htmlspecialchars(trim($_POST['originalMovieID']));
    $originalVoiceActorID = htmlspecialchars(trim($_POST['originalVoiceActorID']));

    $dbCon = dbCon($user, $pass);

    // prepare the statement using original keys in the WHERE clause
    $query = $dbCon->prepare("UPDATE MovieVoiceActor SET MovieID = :movieID, VoiceActorID = :voiceActorID WHERE MovieID = :originalMovieID AND VoiceActorID = :originalVoiceActorID");

    // Bind new values for updating
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':voiceActorID', $voiceActorID);

    // Bind original values for WHERE clause
    $query->bindParam(':originalMovieID', $originalMovieID);
    $query->bindParam(':originalVoiceActorID', $originalVoiceActorID);

    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&MovieID=$movieID&VoiceActorID=$voiceActorID");

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>

<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['MovieID']) && isset($_POST['VoiceActorID']) && isset($_POST['originalMovieID']) && isset($_POST['originalVoiceActorID']) && isset($_POST['submit'])) {
    // Get new values from the form
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $voiceActorID = htmlspecialchars(trim($_POST['VoiceActorID']));
    
    // Get original values to identify the record
    $originalMovieID = htmlspecialchars(trim($_POST['originalMovieID']));
    $originalVoiceActorID = htmlspecialchars(trim($_POST['originalVoiceActorID']));

    $dbCon = dbCon($user, $pass);

    // Prepare the statement using original keys in the WHERE clause
    $query = $dbCon->prepare("UPDATE MovieVoiceActor SET MovieID = :movieID, VoiceActorID = :voiceActorID WHERE MovieID = :originalMovieID AND VoiceActorID = :originalVoiceActorID");

    // Bind new values for updating
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':VoiceActorID', $voiceActorID);

    // Bind original values for WHERE clause
    $query->bindParam(':originalMovieID', $originalMovieID);
    $query->bindParam(':originalVoiceActorID', $originalVoiceActorID);

    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&MovieID=$movieID&VoiceActorID=$voiceActorID");

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>