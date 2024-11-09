<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']));
    $city = htmlspecialchars(trim($_POST['City']));

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO PostalCode (PostalCode, City) VALUES (:postalCode, :city)");

    // Prepare statements
    $query->bindParam(':postalCode', $postalCode);
    $query->bindParam(':city', $city);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>