<?php 
require_once "dbcon.php";
if (isset($_GET['ID'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<?php
$entryID = $_GET['ID'];
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM News WHERE NewsID=$entryID");

$query->execute();
$getNews = $query->fetchAll();
?>
<body>

<div class="container">
        <h3>Editing News "<?php echo $getNews[0][1]; ?>"</h3>
        <form class="col s12" name="contact" method="post" action="updateNews.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Headline" name="Headline" type="text" value="<?php echo $getNews[0][1]; ?>" class="validate" required="" aria-required="true">
                    <label for="Headline">Headline</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="SubHeadline" name="SubHeadline" type="text" value="<?php echo $getNews[0][2]; ?>" class="validate" required="" aria-required="true">
                    <label for="SubHeadline">Subheadline</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="TextOfNews" name="TextOfNews" class="materialize-textarea" required=""><?php echo $getNews[0][3]; ?></textarea>
                    <label for="TextOfNews">Text of News</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="NewsImage" name="NewsImage" type="text" value="<?php echo $getNews[0][4]; ?>" class="validate" required="">
                    <label for="NewsImage">News Image URL</label>
                </div>
            </div>

            <input type="hidden" name="entryID" value="<?php echo $entryID; ?>">
            <button class="btn waves-effect waves-light" type="submit" name="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>
<?php 
} else { 
    header("Location: admin.php?status=0");
}
?>
