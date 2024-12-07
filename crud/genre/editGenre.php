<?php 
require_once "includes/dbcon.php";
confirm_logged_in();

if (isset($_GET['ID'])) {

// get the genre to edit
$genreID = htmlspecialchars(trim($_GET['ID']));
$query = $dbCon->prepare("SELECT * FROM Genre WHERE GenreID = :genreID");
$query->bindParam(':genreID', $genreID);
$query->execute();
$getGenre = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Genre</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<div class="container">
        <h3>Editing genre for "<?php echo htmlspecialchars(trim($getGenre[0]['GenreName'])); ?>"</h3>
        <form class="col s12" name="contact" method="post" action="controllers/update.php">
            <!-- hidden input to connect to controller and oop -->
            <input type="hidden" name="table" value="Genre">
            <input type="hidden" name="original_GenreID" value="<?php echo htmlspecialchars(trim($genreID)); ?>">

            <div class="row">
                <div class="input-field col s12">
                    <input id="GenreName" name="GenreName" type="text" value="<?php echo htmlspecialchars(trim($getGenre[0]['GenreName'])); ?>" class="validate" required="" aria-required="true">
                    <label for="GenreName">Genre name</label>
                </div>
            </div>

            <input type="hidden" name="GenreID" value="<?php echo htmlspecialchars(trim($genreID)); ?>">

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