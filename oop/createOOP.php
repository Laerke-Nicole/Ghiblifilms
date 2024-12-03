<?php
class CreateModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Generic create method
    public function create($table, $data) {
        // Build query dynamically
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($query);

        // Bind values
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }

        // Execute and return success status
        return $stmt->execute();
    }
}