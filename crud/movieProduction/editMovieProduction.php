<?php 
require_once "includes/dbcon.php";

if (isset($_GET['MovieID']) && isset($_GET['ProductionID'])) {
    $movieID = htmlspecialchars($_GET['MovieID']);
    $productionID = htmlspecialchars($_GET['ProductionID']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit movie production</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM MovieProduction WHERE MovieID = :movieID AND ProductionID = :productionID");
$query->bindParam(':movieID', $movieID);
$query->bindParam(':productionID', $productionID);
$query->execute();
$getMovieProduction = $query->fetchAll();
?>

<body>
<div class="container">
    <h3>Editing movie production team for "<?php echo htmlspecialchars($getMovieProduction[0]['MovieID']); ?>"</h3>
    <form class="col s12" name="contact" method="post" action="crud/movieProduction/updateMovieProduction.php">
        <div class="row">
            <div class="input-field col s6">
                <input id="MovieID" name="MovieID" type="number" value="<?php echo htmlspecialchars($getMovieProduction[0]['MovieID']); ?>" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>
            <div class="input-field col s6">
                <input id="ProductionID" name="ProductionID" type="number" value="<?php echo htmlspecialchars($getMovieProduction[0]['ProductionID']); ?>" class="validate" required="" aria-required="true">
                <label for="ProductionID">ProductionID</label>
            </div>
        </div>

        <input type="hidden" name="originalMovieID" value="<?php echo htmlspecialchars($movieID); ?>">
        <input type="hidden" name="originalProductionID" value="<?php echo htmlspecialchars($productionID); ?>">

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