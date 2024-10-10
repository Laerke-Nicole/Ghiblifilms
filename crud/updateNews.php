<?php
require_once "dbcon.php";
if (isset($_POST['entryID']) && isset($_POST['submit'])) {
    $headline = $_POST['Headline'];
    $subHeadline = $_POST['SubHeadline'];
    $textOfNews = $_POST['TextOfNews'];
    $newsImage = $_POST['NewsImage'];
    $entryID = $_POST['entryID'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("UPDATE News SET `Headline`='$headline', `SubHeadline`='$subHeadline', `TextOfNews`='$textOfNews', `NewsImage`='$newsImage' WHERE NewsID=$entryID");
    $query->execute();
    header("Location: admin.php?status=news_updated&ID=$entryID");

} else {
    header("Location: admin.php?status=0");
}
?>
