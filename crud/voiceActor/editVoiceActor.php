<?php 
require_once "includes/dbcon.php";

if (isset($_GET['ID'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Voice Actor</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
$voiceActorID = htmlspecialchars($_GET['ID']);
$query = $dbCon->prepare("SELECT * FROM VoiceActor WHERE VoiceActorID = :voiceActorID");
$query->bindParam(':voiceActorID', $voiceActorID);
$query->execute();
$getVoiceActor = $query->fetchAll();
?>

<body>

    <div class="container">
        <h3>Editing voice actor for "<?php echo htmlspecialchars($getVoiceActor[0]['FirstName'] . ' ' . $getVoiceActor[0]['LastName']); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="crud/voiceActor/updateVoiceActor.php">
            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" value="<?php echo htmlspecialchars($getVoiceActor[0]['FirstName']); ?>" class="validate" required="" aria-required="true">
                    <label for="FirstName">FirstName</label>
                </div>

                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" value="<?php echo htmlspecialchars($getVoiceActor[0]['LastName']); ?>" class="validate" required="" aria-required="true">
                    <label for="LastName">LastName</label>
                </div>
            </div>

            <input type="hidden" name="VoiceActorID" value="<?php echo htmlspecialchars($voiceActorID); ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update
            </button>
        </form>
    </div>
</div>
</body>
</html>

<?php 
} else {    
    header("Location: ../index.php?page=admin&status=0");
}
?>