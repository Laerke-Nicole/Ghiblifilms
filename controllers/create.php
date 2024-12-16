<?php
require_once "../includes/dbcon.php";
require_once "../oop/createOOP.php";

// if form is submitted
if (isset($_POST['submit'])) {
    $table = htmlspecialchars(trim($_POST['table']));

    // separate data and foreign keys
    $data = [];
    $foreignKeys = [];

    // loop through the form fields
    foreach ($_POST as $key => $value) {
        if ($key === 'submit' || $key === 'table') continue;

        if (str_contains($key, 'fk_')) {
            // foreign keys with underscore in the name
            $parts = explode('_', $key, 3);
            $foreignTable = $parts[1];
            $fieldName = $parts[2];

            // if foreign keys arent set yet, create them
            if (!isset($foreignKeys[$foreignTable])) {
                $foreignKeys[$foreignTable] = [
                    'table' => $foreignTable,
                    'data' => [],
                    // primary key with ID at the end
                    'primaryKey' => $foreignTable . 'ID', 
                ];
            }

            $foreignKeys[$foreignTable]['data'][$fieldName] = htmlspecialchars(trim($value));
        } else {
            $data[$key] = htmlspecialchars(trim($value));
        }
    }

    // start the CreateModel
    $createModel = new CreateModel($dbCon);
    $success = $createModel->create($table, $data, $foreignKeys);

    // if success go to admin page
    if ($success) {
        header("Location: ../index.php?page=admin&status=added");
        exit;
    } else {
        header("Location: ../index.php?page=admin&status=error");
        exit;
    }
}