<?php
require_once "includes/dbcon.php";
require_once "oop/deleteOOP.php";

// if btn is clicked
if (isset($_GET['table']) && isset($_GET['primaryKey']) && isset($_GET['primaryKeyValue'])) {
    $table = htmlspecialchars(trim($_GET['table']));
    $primaryKey = htmlspecialchars(trim($_GET['primaryKey']));
    $primaryKeyValue = htmlspecialchars(trim($_GET['primaryKeyValue']));
    $redirectPage = htmlspecialchars(trim($_GET['redirect'] ?? 'admin'));

    // start DeleteModel
    $deleteModel = new DeleteModel($dbCon);
    $success = $deleteModel->delete($table, $primaryKey, $primaryKeyValue);

    // go to admin page if success
    if ($success) {
        $redirectUrl = "index.php?page=" . urlencode($redirectPage) . "&status=deleted&" . urlencode($primaryKey) . "=" . urlencode($primaryKeyValue);
        echo "<script>window.location.href='$redirectUrl';</script>";
        exit;
    } else {
        header("Location: index.php?page=admin&status=0");
        exit;
    }
} else {
    echo "Error: Deleting failed";
    exit;
}