<?php 
require_once ("includes/dbcon.php");
require_once ("includes/csrfProtection.php");
confirm_logged_in();

if (isset($_GET['MovieID']) && isset($_GET['GenreID'])) {
    $movieID = htmlspecialchars(trim($_GET['MovieID']));
    $genreID = htmlspecialchars(trim($_GET['GenreID']));

// get the movie genre to edit
$query = $dbCon->prepare("SELECT * FROM MovieGenre WHERE MovieID = :movieID AND GenreID = :genreID");
$query->bindParam(':movieID', $movieID);
$query->bindParam(':genreID', $genreID);
$query->execute();
$getMovieGenre = $query->fetchAll();
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
</head>

<body>
<div class="container">
<h3>Editing movie genre for "<?php echo htmlspecialchars(trim($getMovieGenre[0]['MovieID'])); ?>"</h3>
    <form class="col s12" name="contact" method="post" action="controllers/update.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- Hidden inputs to identify the table and composite keys -->
        <input type="hidden" name="table" value="MovieGenre">
        <input type="hidden" name="original_MovieID" value="<?php echo htmlspecialchars(trim($movieID)); ?>">
        <input type="hidden" name="original_GenreID" value="<?php echo htmlspecialchars(trim($genreID)); ?>">

        <div class="row">
            <div class="input-field col s6">
                <input id="MovieID" name="MovieID" type="number" value="<?php echo htmlspecialchars(trim($getMovieGenre[0]['MovieID'])); ?>" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>
            <div class="input-field col s6">
                <input id="GenreID" name="GenreID" type="number" value="<?php echo htmlspecialchars(trim($getMovieGenre[0]['GenreID'])); ?>" class="validate" required="" aria-required="true">
                <label for="GenreID">GenreID</label>
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