<?php
require_once "../includes/dbcon.php";
require_once "../oop/updateOOP.php";

if (isset($_POST['submit'])) {
    $table = htmlspecialchars(trim($_POST['table']));
    $redirectPage = htmlspecialchars(trim($_POST['redirect'] ?? 'admin'));

    // Extract composite keys dynamically
    $originalKeys = [];
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'original_') === 0) {
            $originalKeys[str_replace('original_', '', $key)] = htmlspecialchars(trim($value));
        }
    }

    // Ensure original keys are not empty
    if (empty($originalKeys)) {
        echo "Error: Missing original keys for the update operation.";
        exit;
    }

    // Separate data and foreign key mappings
    $data = [];
    $foreignKeys = [];

    foreach ($_POST as $key => $value) {
        if (in_array($key, ['submit', 'table', 'redirect']) || strpos($key, 'original_') === 0) continue;

        if (str_contains($key, 'fk_')) {
            $parts = explode('_', $key, 3); // Example: fk_Address_StreetName
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

    // Log data and foreign keys for debugging
    error_log("Data to update: " . print_r($data, true));
    error_log("Foreign Keys: " . print_r($foreignKeys, true));

    // Initialize UpdateModel and call updateWithCompositeKey
    $updateModel = new UpdateModel($dbCon);
    $success = $updateModel->updateWithCompositeKey($table, $originalKeys, $data, $foreignKeys);

    // Build dynamic redirect URL
    if ($success) {
        $redirectUrl = "../index.php?page=" . urlencode($redirectPage) . "&status=updated";

        // Append ID if available in originalKeys
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