<?php
require_once "dbcon.php";
if (isset($_POST['submit'])) {
    $headline = $_POST['Headline'];
    $subHeadline = $_POST['SubHeadline'];
    $textOfNews = $_POST['TextOfNews'];
    $newsImage = $_POST['NewsImage'];

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO News (`Headline`, `SubHeadline`, `TextOfNews`, `NewsImage`) VALUES ('$headline', '$subHeadline', '$textOfNews', '$newsImage')");
    $query->execute();
    header("Location: admin.php?status=news_added");

} else {
    header("Location: admin.php?status=0");
}
?>
