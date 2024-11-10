<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars
    $firstName = htmlspecialchars(trim($_POST['FirstName']));
    $lastName = htmlspecialchars(trim($_POST['LastName']));

    $dbCon = dbCon($user, $pass);
    $query = $dbCon->prepare("INSERT INTO VoiceActor (FirstName, LastName) VALUES (:firstName, :lastName)");

    // Prepare statements
    $query->bindParam(':firstName', $firstName);
    $query->bindParam(':lastName', $lastName);
    $query->execute();

    header("Location: ../../index.php?page=admin&status=added");
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>