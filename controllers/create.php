<?php
require_once "../includes/dbcon.php";
require_once "../oop/createOOP.php";

if (isset($_POST['submit'])) {
    $table = htmlspecialchars(trim($_POST['table']));

    // Separate data and foreign key mappings
    $data = [];
    $foreignKeys = [];

    foreach ($_POST as $key => $value) {
        if ($key === 'submit' || $key === 'table') continue;

        if (str_contains($key, 'fk_')) {
            // Foreign key pattern: fk_{ForeignTable}_{FieldName}
            $parts = explode('_', $key, 3); // Example: fk_Address_StreetName
            $foreignTable = $parts[1];
            $fieldName = $parts[2];

            if (!isset($foreignKeys[$foreignTable])) {
                $foreignKeys[$foreignTable] = [
                    'table' => $foreignTable,
                    'data' => [],
                    'primaryKey' => $foreignTable . 'ID', // Assuming primary key is {TableName}ID
                ];
            }

            $foreignKeys[$foreignTable]['data'][$fieldName] = htmlspecialchars(trim($value));
        } else {
            // Main table data
            $data[$key] = htmlspecialchars(trim($value));
        }
    }

    // Initialize the CreateModel and create the record
    $createModel = new CreateModel($dbCon);
    $success = $createModel->create($table, $data, $foreignKeys);

    // Redirect based on success or failure
    if ($success) {
        header("Location: ../index.php?page=admin&status=added");
        exit;
    } else {
        header("Location: ../index.php?page=admin&status=error");
        exit;
    }
}