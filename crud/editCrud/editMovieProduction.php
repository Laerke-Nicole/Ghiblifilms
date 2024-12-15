<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
require_once ("oop/getIDOOP.php");
confirm_logged_in();

try {
    $params = GetID::getValues(['MovieID', 'ProductionID']);
    $movieID = $params['MovieID'];
    $productionID = $params['ProductionID'];
} catch (Exception $e) { 
    header("Location: ../index.php?page=admin&status=0");
}

include ("controllers/adminController.php");
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
    <script src="js/dropdown.js" defer></script>
</head>

<body>
<div class="container">
    <h3>Editing movie production team</h3>
    <form class="col s12" name="contact" method="post" action="controllers/update.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- hidden input to connect to controller and oop -->
        <input type="hidden" name="table" value="MovieProduction">
        <input type="hidden" name="original_MovieID" value="<?php echo htmlspecialchars(trim($movieID)); ?>">
        <input type="hidden" name="original_ProductionID" value="<?php echo htmlspecialchars(trim($productionID)); ?>">

        <div class="row">
            <div class="input-field col s6">
                <p>Movie name</p>
                <select name="MovieID" id="MovieID">
                    <?php
                    include ("controllers/adminController.php");
                    while ($movie = $movieQuery->fetch()) {
                        $selected = $movie['MovieID'] == $getMovieProduction[0]['MovieID'] ? 'selected' : '';
                        echo "<option value='{$movie['MovieID']}' $selected>{$movie['Name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-field col s6">
                <p>Production name</p>
                <select name="ProductionID" id="ProductionID">
                    <?php
                    include ("controllers/adminController.php");
                    while ($production = $productionQuery->fetch()) {
                        $selected = $production['ProductionID'] == $getMovieProduction[0]['ProductionID'] ? 'selected' : '';
                        echo "<option value='{$production['ProductionID']}' $selected>{$production['FirstName']} {$production['LastName']}</option>";
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