<?php 
require_once "../../includes/dbcon.php";
if (isset($_GET['ID'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Movie</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$movieID = htmlspecialchars(trim($_GET['ID']));

$dbCon = dbCon($user, $pass);

$query = $dbCon->prepare("SELECT * FROM Movie WHERE MovieID = :movieID");
$query->bindParam(':movieID', $movieID, PDO::PARAM_INT);
$query->execute();
$getMovie = $query->fetchAll();
?>
<body>

<div class="container">
    <h3>Editing Movie "<?php echo htmlspecialchars($getMovie[0]['Name']); ?>"</h3>
    <form class="col s12" name="contact" method="post" action="updateMovie.php">
        <div class="row">
            <div class="input-field col s12">
                <input id="Name" name="Name" type="text" value="<?php echo htmlspecialchars($getMovie[0]['Name']); ?>" class="validate" required>
                <label for="Name">Movie Name</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <textarea id="Description" name="Description" class="materialize-textarea" required><?php echo htmlspecialchars($getMovie[0]['Description']); ?></textarea>
                <label for="Description">Description</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="ReleaseYear" name="ReleaseYear" type="number" value="<?php echo htmlspecialchars($getMovie[0]['ReleaseYear']); ?>" class="validate" required>
                <label for="ReleaseYear">Release Year</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="Duration" name="Duration" type="text" value="<?php echo htmlspecialchars($getMovie[0]['Duration']); ?>" class="validate" required>
                <label for="Duration">Duration</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <?php echo "<img src='" . $getMovie[0]['MovieImg'] . "' alt='Movie Image' width='100'>"; ?>
                <input id="MovieImg" name="MovieImg" type="file" value="<?php echo htmlspecialchars($getMovie[0]['MovieImg']); ?>" class="validate">
                <label for="MovieImg">Movie Image</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <label for="ScreenFormatID">Screen Format</label>
                <select id="ScreenFormatID" name="ScreenFormatID" class="browser-default" required>

                    <?php
                    $formatQuery = $dbCon->prepare("SELECT ScreenFormatID, ScreenFormat FROM ScreenFormat");
                    $formatQuery->execute();
                    $formats = $formatQuery->fetchAll();
                    foreach ($formats as $format) {
                        $selected = $format['ScreenFormatID'] == $getMovie[0]['ScreenFormatID'] ? 'selected' : '';
                        echo "<option value='" . $format['ScreenFormatID'] . "' $selected>" . htmlspecialchars($format['ScreenFormat']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <input type="hidden" name="MovieID" value="<?php echo htmlspecialchars($movieID); ?>">

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