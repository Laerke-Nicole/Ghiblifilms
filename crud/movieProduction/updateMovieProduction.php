<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['MovieID']) && isset($_POST['ProductionID']) && isset($_POST['originalMovieID']) && isset($_POST['originalProductionID']) && isset($_POST['submit'])) {
    // get the new values from the form on editMovieProduction.php
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $productionID = htmlspecialchars(trim($_POST['ProductionID']));
    
    // get the first values to identify the record
    $originalMovieID = htmlspecialchars(trim($_POST['originalMovieID']));
    $originalProductionID = htmlspecialchars(trim($_POST['originalProductionID']));

    // prepare the statement using original keys in the WHERE clause
    $query = $dbCon->prepare("UPDATE MovieProduction SET MovieID = :movieID, ProductionID = :productionID WHERE MovieID = :originalMovieID AND ProductionID = :originalProductionID");

    // Bind new values for updating
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':productionID', $productionID);

    // Bind original values for WHERE clause
    $query->bindParam(':originalMovieID', $originalMovieID);
    $query->bindParam(':originalProductionID', $originalProductionID);

    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&MovieID=$movieID&ProductionID=$productionID");

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>

<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['MovieID']) && isset($_POST['ProductionID']) && isset($_POST['originalMovieID']) && isset($_POST['originalProductionID']) && isset($_POST['submit'])) {
    // Get new values from the form
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $productionID = htmlspecialchars(trim($_POST['ProductionID']));
    
    // Get original values to identify the record
    $originalMovieID = htmlspecialchars(trim($_POST['originalMovieID']));
    $originalProductionID = htmlspecialchars(trim($_POST['originalProductionID']));

    // Prepare the statement using original keys in the WHERE clause
    $query = $dbCon->prepare("UPDATE MovieProduction SET MovieID = :movieID, ProductionID = :productionID WHERE MovieID = :originalMovieID AND ProductionID = :originalProductionID");

    // Bind new values for updating
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':productionID', $productionID);

    // Bind original values for WHERE clause
    $query->bindParam(':originalMovieID', $originalMovieID);
    $query->bindParam(':originalProductionID', $originalProductionID);

    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&MovieID=$movieID&ProductionID=$productionID");

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>