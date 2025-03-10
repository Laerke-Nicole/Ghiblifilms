<?php 
require_once "includes/dbcon.php";
require_once ("includes/csrfProtection.php");
require_once ("oop/getIDOOP.php");
confirm_is_admin();

// get the movie id from the url
try {
    // retrieve the id from the url with GetID::getValues
    $params = GetID::getValues(['ID']);
    // assign the id to movieid
    $movieID = $params['ID'];
    
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
    <title>Edit Movie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<div class="container">
    <h3>Editing Movie "<?php echo htmlspecialchars(trim($getMovie[0]['Name'])); ?>"</h3>
    <form class="col s12" name="contact" method="post" action="crud/movie/updateMovie.php" enctype="multipart/form-data">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <div class="row">
            <div class="input-field col s12">
                <input id="Name" name="Name" type="text" value="<?php echo htmlspecialchars(trim($getMovie[0][1])); ?>" class="validate" required>
                <label for="Name">Movie Name</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <textarea id="Description" name="Description" class="materialize-textarea" required><?php echo htmlspecialchars(trim($getMovie[0][2])); ?></textarea>
                <label for="Description">Description</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="ReleaseYear" name="ReleaseYear" type="number" value="<?php echo htmlspecialchars(trim($getMovie[0][3])); ?>" class="validate" required>
                <label for="ReleaseYear">Release Year</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="Duration" name="Duration" type="text" value="<?php echo htmlspecialchars(trim($getMovie[0][4])); ?>" class="validate" required>
                <label for="Duration">Duration</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <?php echo "<img src='upload/" . $getMovie[0][5] . "' alt='Image of news' width='100'>"; ?>
                <input id="MovieImg" name="MovieImg" type="file" value="<?php echo htmlspecialchars(trim($getMovie[0][5])); ?>" class="validate" required="">
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="MovieTrailer" name="MovieTrailer" type="text" value="<?php echo htmlspecialchars(trim($getMovie[0]['MovieTrailer'])); ?>" class="validate" required>
                <label for="MovieTrailer">Movie trailer</label>
            </div>
        </div>
        

        <input type="hidden" name="MovieID" value="<?php echo htmlspecialchars(trim($movieID)); ?>">

        <button class="btn waves-effect waves-light" type="submit" name="submit">Update</button>
    </form>
</div>
</body>
</html>