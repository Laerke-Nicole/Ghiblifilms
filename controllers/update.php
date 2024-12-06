<?php
require_once "../includes/dbcon.php";
require_once "../oop/UpdateModel.php";

if (isset($_POST['submit'])) {
    $table = htmlspecialchars(trim($_POST['table']));
    $primaryKey = htmlspecialchars(trim($_POST['primaryKey']));
    $id = htmlspecialchars(trim($_POST['id']));

    // Separate data and foreign key mappings
    $data = [];
    $foreignKeys = [];

    foreach ($_POST as $key => $value) {
        if (in_array($key, ['submit', 'table', 'primaryKey', 'id'])) continue;

        if (str_contains($key, 'fk_')) {
            $parts = explode('_', $key, 3); // Example: fk_Auditorium_AuditoriumID
            $foreignTable = $parts[1];
            $fieldName = $parts[2];

            if (!isset($foreignKeys[$foreignTable])) {
                $foreignKeys[$foreignTable] = [
                    'table' => $foreignTable,
                    'data' => [],
                    'primaryKey' => $foreignTable . 'ID' // Assuming primary key is {TableName}ID
                ];
            }

            $foreignKeys[$foreignTable]['data'][$fieldName] = htmlspecialchars(trim($value));
        } else {
            $data[$key] = htmlspecialchars(trim($value));
        }
    }

    // Initialize UpdateModel and call update method
    $updateModel = new UpdateModel($dbCon);
    $success = $updateModel->update($table, $primaryKey, $id, $data, $foreignKeys);

    // Redirect based on success or failure
    if ($success) {
        header("Location: ../index.php?page=admin&status=updated&ID=$id");
    } else {
        echo "Error: Failed to update.";
    }
}