<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
require_once ("oop/getIDOOP.php");

confirm_logged_in();

try {
    $params = GetID::getValues(['MovieID', 'GenreID']);
    $movieID = $params['MovieID'];
    $genreID = $params['GenreID'];
} catch (Exception $e) { 
    header("Location: ../index.php?page=admin&status=0");
    exit;
}

include ("controllers/adminController.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit movie genre</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="js/dropdown.js" defer></script>
</head>

<body>
<div class="container">
<h3>Editing movie genre</h3>
    <form class="col s12" name="contact" method="post" action="controllers/update.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- Hidden inputs to identify the table and composite keys -->
        <input type="hidden" name="table" value="MovieGenre">
        <input type="hidden" name="original_MovieID" value="<?php echo htmlspecialchars(trim($movieID)); ?>">
        <input type="hidden" name="original_GenreID" value="<?php echo htmlspecialchars(trim($genreID)); ?>">

        <div class="row">
            <div class="input-field col s6">
                <p>Movie name</p>
                <select name="MovieID" id="MovieID">
                    <?php
                    include ("controllers/adminController.php");
                    while ($movie = $movieQuery->fetch()) {
                        $selected = $movie['MovieID'] == $getMovieGenre[0]['MovieID'] ? 'selected' : '';
                        echo "<option value='{$movie['MovieID']}' $selected>{$movie['Name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="input-field col s6">
                <p>Genre name</p>
                <select name="GenreID" id="GenreID">
                    <?php
                    include ("controllers/adminController.php");
                    while ($genre = $genreQuery->fetch()) {
                        $selected = $genre['GenreID'] == $getMovieGenre[0]['GenreID'] ? 'selected' : '';
                        echo "<option value='{$genre['GenreID']}' $selected>{$genre['GenreName']}</option>";
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