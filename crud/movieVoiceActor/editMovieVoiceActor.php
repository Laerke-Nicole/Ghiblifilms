<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
confirm_logged_in();

if (isset($_GET['MovieID']) && isset($_GET['VoiceActorID'])) {
    $movieID = htmlspecialchars(trim($_GET['MovieID']));
    $voiceActorID = htmlspecialchars(trim($_GET['VoiceActorID']));

// get the movie voice actor to edit
$query = $dbCon->prepare("SELECT * FROM MovieVoiceActor WHERE MovieID = :movieID AND VoiceActorID = :voiceActorID");
$query->bindParam(':movieID', $movieID);
$query->bindParam(':voiceActorID', $voiceActorID);
$query->execute();
$getMovieVoiceActor = $query->fetchAll();
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

<body>
<div class="container">
    <h3>Editing movie voice actor for "<?php echo htmlspecialchars(trim($getMovieVoiceActor[0]['MovieID'])); ?>"</h3>
    <form class="col s12" name="contact" method="post" action="controllers/update.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- hidden input to connect to controller and oop -->
        <input type="hidden" name="table" value="MovieVoiceActor">
        <input type="hidden" name="original_MovieID" value="<?php echo htmlspecialchars(trim($movieID)); ?>">
        <input type="hidden" name="original_VoiceActorID" value="<?php echo htmlspecialchars(trim($voiceActorID)); ?>">

        <div class="row">
            <div class="input-field col s6">
                <input id="MovieID" name="MovieID" type="number" value="<?php echo htmlspecialchars(trim($getMovieVoiceActor[0]['MovieID'])); ?>" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>
            <div class="input-field col s6">
                <input id="VoiceActorID" name="VoiceActorID" type="number" value="<?php echo htmlspecialchars(trim($getMovieVoiceActor[0]['VoiceActorID'])); ?>" class="validate" required="" aria-required="true">
                <label for="VoiceActorID">VoiceActorID</label>
            </div>
        </div>

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