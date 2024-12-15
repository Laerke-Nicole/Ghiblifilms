<?php
require_once "includes/dbcon.php";
require_once "oop/deleteOOP.php";

if (isset($_GET['table']) && isset($_GET['primaryKey']) && isset($_GET['primaryKeyValue'])) {
    $table = htmlspecialchars(trim($_GET['table']));
    $primaryKey = htmlspecialchars(trim($_GET['primaryKey']));
    $primaryKeyValue = htmlspecialchars(trim($_GET['primaryKeyValue']));
    $redirectPage = htmlspecialchars(trim($_GET['redirect'] ?? 'admin')); // Default to 'admin' if not specified

    // Initialize the DeleteModel
    $deleteModel = new DeleteModel($dbCon);
    $success = $deleteModel->delete($table, $primaryKey, $primaryKeyValue);

    // Redirect based on success or failure
    if ($success) {
        // Redirect to the dynamic page
        header("Location: index.php?page=" . urlencode($redirectPage) . "&status=deleted&ID=" . urlencode($primaryKeyValue));
        exit;
    } else {
        echo "Error: Deletion failed.";
        exit;
    }
} else {
    echo "Error: Missing required parameters.";
    exit;
}