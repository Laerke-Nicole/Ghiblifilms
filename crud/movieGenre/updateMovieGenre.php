<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['MovieID']) && isset($_POST['GenreID']) && isset($_POST['originalMovieID']) && isset($_POST['originalGenreID']) && isset($_POST['submit'])) {
    // get the new values from the form on editMovieGenre.php
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $genreID = htmlspecialchars(trim($_POST['GenreID']));
    
    // get the first values to identify the record
    $originalMovieID = htmlspecialchars(trim($_POST['originalMovieID']));
    $originalGenreID = htmlspecialchars(trim($_POST['originalGenreID']));

    $dbCon = dbCon($user, $pass);

    // prepare the statement using original keys in the WHERE clause
    $query = $dbCon->prepare("UPDATE MovieGenre SET MovieID = :movieID, GenreID = :genreID WHERE MovieID = :originalMovieID AND GenreID = :originalGenreID");

    // Bind new values for updating
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':genreID', $genreID);

    // Bind original values for WHERE clause
    $query->bindParam(':originalMovieID', $originalMovieID);
    $query->bindParam(':originalGenreID', $originalGenreID);

    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&MovieID=$movieID&GenreID=$genreID");

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>

<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['MovieID']) && isset($_POST['GenreID']) && isset($_POST['originalMovieID']) && isset($_POST['originalGenreID']) && isset($_POST['submit'])) {
    // Get new values from the form
    $movieID = htmlspecialchars(trim($_POST['MovieID']));
    $genreID = htmlspecialchars(trim($_POST['GenreID']));
    
    // Get original values to identify the record
    $originalMovieID = htmlspecialchars(trim($_POST['originalMovieID']));
    $originalGenreID = htmlspecialchars(trim($_POST['originalGenreID']));

    $dbCon = dbCon($user, $pass);

    // Prepare the statement using original keys in the WHERE clause
    $query = $dbCon->prepare("UPDATE MovieGenre SET MovieID = :movieID, GenreID = :genreID WHERE MovieID = :originalMovieID AND GenreID = :originalGenreID");

    // Bind new values for updating
    $query->bindParam(':movieID', $movieID);
    $query->bindParam(':genreID', $genreID);

    // Bind original values for WHERE clause
    $query->bindParam(':originalMovieID', $originalMovieID);
    $query->bindParam(':originalGenreID', $originalGenreID);

    $query->execute();

    header("Location: ../../index.php?page=admin&status=updated&MovieID=$movieID&GenreID=$genreID");

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>