<?php
require_once "dbcon.php";

if (isset($_POST['NewsID']) && isset($_POST['submit'])) {
    $headline = htmlspecialchars(trim($_POST['Headline']), ENT_QUOTES, 'UTF-8');
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']), ENT_QUOTES, 'UTF-8');
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']), ENT_QUOTES, 'UTF-8');
    $newsImage = htmlspecialchars(trim($_POST['NewsImage']), ENT_QUOTES, 'UTF-8');
    $newsID = htmlspecialchars(trim($_POST['NewsID']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);

    $query = $dbCon->prepare("UPDATE News SET `Headline` = :headline, `SubHeadline` = :subHeadline, `TextOfNews` = :textOfNews, `NewsImage` = :newsImage WHERE NewsID = :newsID");

    $query->bindParam(':headline', $headline);
    $query->bindParam(':subHeadline', $subHeadline);
    $query->bindParam(':textOfNews', $textOfNews);
    $query->bindParam(':newsImage', $newsImage);
    $query->bindParam(':newsID', $newsID, PDO::PARAM_INT);
    
    $query->execute();

    header("Location: ../index.php?page=admin&status=updated&ID=$newsID");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>