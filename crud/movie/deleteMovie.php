<?php
require_once "../../includes/dbcon.php";

if (isset($_GET['MovieID'])) {
    $movieID = htmlspecialchars(trim($_GET['MovieID']));

    $dbCon = dbCon($user, $pass);

    // Prepare the statement
    $query = $dbCon->prepare("DELETE FROM Movie WHERE MovieID = :movieID");

    // bind
    $query->bindParam(':movieID', $movieID, PDO::PARAM_INT);

    if ($query->execute()) {
        header("Location: ../index.php?page=admin&status=deleted&ID=$movieID");
    } else {
        header("Location: ../index.php?page=admin&status=error");
    }

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>
