<?php
require_once "dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $headline = htmlspecialchars(trim($_POST['Headline']), ENT_QUOTES, 'UTF-8');
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']), ENT_QUOTES, 'UTF-8');
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']), ENT_QUOTES, 'UTF-8');
    $newsImage = htmlspecialchars(trim($_POST['NewsImage']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);

    // prepare statements
    $query = $dbCon->prepare("INSERT INTO News (`Headline`, `SubHeadline`, `TextOfNews`, `NewsImage`) VALUES (:headline, :subHeadline, :textOfNews, :newsImage)");
    $query->bindParam(':headline', $headline);
    $query->bindParam(':subHeadline', $subHeadline);
    $query->bindParam(':textOfNews', $textOfNews);
    $query->bindParam(':newsImage', $newsImage);

    $query->execute();

    header("Location: ../index.php?page=admin&status=added");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>