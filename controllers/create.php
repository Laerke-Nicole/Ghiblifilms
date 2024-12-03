<?php
require_once "../includes/dbcon.php";
require_once "../oop/createOOP.php";

if (isset($_POST['submit'])) {
    // Table name from the form
    $table = htmlspecialchars(trim($_POST['table']));

    // Dynamically get form data excluding `submit` and `table`
    $data = array_filter($_POST, function ($key) {
        return $key !== 'submit' && $key !== 'table';
    }, ARRAY_FILTER_USE_KEY);

    // Initialize createModel
    $createModel = new CreateModel($dbCon);

    // Call create method
    $success = $createModel->create($table, $data);

    // Redirect based on success or failure
    if ($success) {
        header("Location: ../index.php?page=admin&status=added");
    } else {
        header("Location: ../index.php?page=admin&status=error");
    }
}
?>