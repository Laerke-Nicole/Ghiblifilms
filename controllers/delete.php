<?php
require_once "../includes/dbcon.php";
require_once "../oop/DeleteModel.php";

if (isset($_GET['table']) && isset($_GET['primaryKey']) && isset($_GET['id'])) {
    $table = htmlspecialchars(trim($_GET['table']));
    $primaryKey = htmlspecialchars(trim($_GET['primaryKey']));
    $id = htmlspecialchars(trim($_GET['id']));

    // Initialize DeleteModel
    $deleteModel = new DeleteModel($dbCon);

    // Call delete method
    $success = $deleteModel->delete($table, $primaryKey, $id);

    // Redirect on success or failure
    if ($success) {
        header("Location: ../index.php?page=admin&status=deleted&ID=$id");
        exit;
    } else {
        echo "Error: Failed to delete.";
        exit;
    }
} else {
    header("Location: ../index.php?page=admin&status=0");
    exit;
}