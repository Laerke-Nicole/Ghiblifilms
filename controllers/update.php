<?php
require_once "../includes/dbcon.php";
require_once "../oop/updateOOP.php";

// if form is submitted
if (isset($_POST['submit'])) {
    $table = htmlspecialchars(trim($_POST['table']));
    $redirectPage = htmlspecialchars(trim($_POST['redirect'] ?? 'admin'));

    // extract keys dynamically
    $originalKeys = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'original_') === 0) {
            $originalKeys[str_replace('original_', '', $key)] = htmlspecialchars(trim($value));
        }
    }

    // ensure original keys are not empty
    if (empty($originalKeys)) {
        echo "Error: Missing original keys for the update operation.";
        exit;
    }

    // separate data and foreign keys
    $data = [];
    $foreignKeys = [];

    // loop through POST data
    foreach ($_POST as $key => $value) {
        if (in_array($key, ['submit', 'table', 'redirect']) || strpos($key, 'original_') === 0) continue;

        if (str_contains($key, 'fk_')) {
            // foreign keys with underscore
            $parts = explode('_', $key, 3);
            $foreignTable = $parts[1];
            $fieldName = $parts[2];

            // if foreign keyys are not set
            if (!isset($foreignKeys[$foreignTable])) {
                $foreignKeys[$foreignTable] = [
                    'table' => $foreignTable,
                    'data' => [],
                    // primary key with ID at the end
                    'primaryKey' => $foreignTable . 'ID'
                ];
            }

            // set foreign key data
            $foreignKeys[$foreignTable]['data'][$fieldName] = htmlspecialchars(trim($value));
        } else {
            $data[$key] = htmlspecialchars(trim($value));
        }
    }

    // start UpdateModel and call updateWithCompositeKey
    $updateModel = new UpdateModel($dbCon);
    $success = $updateModel->updateWithCompositeKey($table, $originalKeys, $data, $foreignKeys);

    // dynamic url link after update
    if ($success) {
        $redirectUrl = "../index.php?page=" . urlencode($redirectPage) . "&status=updated";

        // append original keys to the redirect URL
        foreach ($originalKeys as $key => $value) {
            $redirectUrl .= "&$key=" . urlencode($value);
        }

        header("Location: $redirectUrl");
        exit;
    } else {
        echo "Error: Update failed.";
    }
}
?>