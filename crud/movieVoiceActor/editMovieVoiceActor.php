<?php 
require_once "includes/dbcon.php";

if (isset($_GET['MovieID']) && isset($_GET['VoiceActorID'])) {
    $movieID = htmlspecialchars($_GET['MovieID']);
    $voiceActorID = htmlspecialchars($_GET['VoiceActorID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit movie voice actor</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM MovieVoiceActor WHERE MovieID = :movieID AND VoiceActorID = :voiceActorID");
$query->bindParam(':movieID', $movieID);
$query->bindParam(':voiceActorID', $voiceActorID);
$query->execute();
$getMovieVoiceActor = $query->fetchAll();
?>

<body>
<div class="container">
    <h3>Editing movie voice actor for "<?php echo htmlspecialchars($getMovieVoiceActor[0]['MovieID']); ?>"</h3>
    <form class="col s12" name="contact" method="post" action="crud/movieVoiceActor/updateMovieVoiceActor.php">
        <div class="row">
            <div class="input-field col s6">
                <input id="MovieID" name="MovieID" type="number" value="<?php echo htmlspecialchars($getMovieVoiceActor[0]['MovieID']); ?>" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>
            <div class="input-field col s6">
                <input id="VoiceActorID" name="VoiceActorID" type="number" value="<?php echo htmlspecialchars($getMovieVoiceActor[0]['VoiceActorID']); ?>" class="validate" required="" aria-required="true">
                <label for="VoiceActorID">VoiceActorID</label>
            </div>
        </div>

        <input type="hidden" name="originalMovieID" value="<?php echo htmlspecialchars($movieID); ?>">
        <input type="hidden" name="originalVoiceActorID" value="<?php echo htmlspecialchars($voiceActorID); ?>">

        <button class="btn waves-effect waves-light" type="submit" name="submit">Update</button>
    </form>
</div>
</body>
</html>

<?php 
} else {    
    header("Location: ../index.php?page=admin&status=0");
}
?>