<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $nameOfRole = htmlspecialchars(trim($_POST['NameOfRole']));

    $query = $dbCon->prepare("INSERT INTO RoleInProduction (NameOfRole) VALUES (:nameOfRole)");

    // Prepare statements
    $query->bindParam(':nameOfRole', $nameOfRole);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>