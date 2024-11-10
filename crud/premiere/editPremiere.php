<?php 
require_once "includes/dbcon.php";

if (isset($_GET['ID'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Premiere</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
$premiereID = htmlspecialchars($_GET['ID']);
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM Premiere WHERE PremiereID = :premiereID");
$query->bindParam(':premiereID', $premiereID);
$query->execute();
$getPremiere = $query->fetchAll();
?>

<body>

    <div class="container">
        <h3>Editing premiere for "<?php echo htmlspecialchars($getPremiere[0]['PremiereID'])?>"</h3>
        <form class="col s12" name="contact" method="post" action="crud/premiere/updatePremiere.php">
            <div class="row">
                <div class="input-field col s6">
                    <input id="MovieID" name="MovieID" type="text" value="<?php echo htmlspecialchars($getPremiere[0]['MovieID']); ?>" class="validate" required="" aria-required="true">
                    <label for="MovieID">MovieID</label>
                </div>

                <div class="input-field col s6">
                    <input id="PremiereDate" name="PremiereDate" type="date" value="<?php echo htmlspecialchars($getPremiere[0]['PremiereDate']); ?>" class="validate" required="" aria-required="true">
                    <label for="PremiereDate">PremiereDate</label>
                </div>
            </div>

            <input type="hidden" name="PremiereID" value="<?php echo htmlspecialchars($premiereID); ?>">

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