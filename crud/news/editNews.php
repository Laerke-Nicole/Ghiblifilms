<?php 
require_once "includes/dbcon.php";
require_once ("oop/getIDOOP.php");
confirm_is_admin();

try {
    $params = GetID::getValues(['ID']);
    $newsID = $params['ID'];
    
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
    <title>Edit News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>

<div class="container">
        <h3>Editing News "<?php echo htmlspecialchars(trim($getNews[0]['Headline'])); ?>"</h3>
        
        <!-- <form class="col s12" name="contact" method="post" action="updateNews.php" enctype="multipart/form-data"> -->
        <form class="col s12" name="contact" method="post" action="crud/news/updateNews.php" enctype="multipart/form-data">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">

            <div class="row">
                <div class="input-field col s12">
                    <input id="Headline" name="Headline" type="text" value="<?php echo htmlspecialchars(trim($getNews[0][1])); ?>" class="validate" required="" aria-required="true">
                    <label for="Headline">Headline</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="SubHeadline" name="SubHeadline" type="text" value="<?php echo htmlspecialchars(trim($getNews[0][2])); ?>" class="validate" required="" aria-required="true">
                    <label for="SubHeadline">Subheadline</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="TextOfNews" name="TextOfNews" class="materialize-textarea" required=""><?php echo htmlspecialchars(trim($getNews[0][3])); ?></textarea>
                    <label for="TextOfNews">Text of News</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <?php echo "<img src='upload/" . $getNews[0][4] . "' alt='Image of news' width='100'>"; ?>
                    <input id="NewsImg" name="NewsImg" type="file" value="<?php echo htmlspecialchars(trim($getNews[0][4])); ?>" class="validate" required="">
                </div>
            </div>


            <input type="hidden" name="NewsID" value="<?php echo htmlspecialchars(trim($newsID)); ?>">

            <button class="btn waves-effect waves-light" type="submit" name="submit">Update</button>
        </form>
    </div>
</div>
</body>
</html>