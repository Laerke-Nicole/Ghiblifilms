<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
require_once ("oop/getIDOOP.php");
confirm_logged_in();

try {
    $params = GetID::getValues(['MovieID', 'VoiceActorID']);
    $movieID = $params['MovieID'];
    $voiceActorID = $params['VoiceActorID'];
} catch (Exception $e) { 
    header("Location: ../index.php?page=admin&status=0");
}

include ("controllers/adminController.php");
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
    <script src="js/dropdown.js" defer></script>
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
                <p>Movie name</p>
                <select name="MovieID" id="MovieID">
                    <?php
                    include ("controllers/adminController.php");
                    while ($movie = $movieQuery->fetch()) {
                        $selected = $movie['MovieID'] == $getMovieVoiceActor[0]['MovieID'] ? 'selected' : '';
                        echo "<option value='{$movie['MovieID']}' $selected>{$movie['Name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-field col s6">
                <p>Voice actor name</p>
                <select name="VoiceActorID" id="VoiceActorID">
                    <?php
                    include ("controllers/adminController.php");
                    while ($voiceActor = $voiceActorQuery->fetch()) {
                        $selected = $voiceActor['VoiceActorID'] == $getMovieVoiceActor[0]['VoiceActorID'] ? 'selected' : '';
                        echo "<option value='{$voiceActor['VoiceActorID']}' $selected>{$voiceActor['FirstName']} {$voiceActor['LastName']}</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Update</button>
    </form>
</div>
</body>
</html>