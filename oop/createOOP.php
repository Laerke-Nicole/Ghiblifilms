<?php
class CreateModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Generic create method
    public function create($table, $data, $foreignKeys = []) {
        $resolvedForeignKeys = [];

        // validate and remove CSRF token from database
        if (isset($data['csrf_token'])) {
            unset($data['csrf_token']); 
        }

        // Handle foreign keys dynamically
        foreach ($foreignKeys as $foreignKey => $config) {
            // Resolve the foreign key and get its primary key value
            $resolvedForeignKeys[$config['primaryKey']] = $this->resolveForeignKey(
                $config['table'],
                $config['data'],
                $config['primaryKey']
            );
        }

        // Merge resolved foreign keys into the main data
        $data = array_merge($data, $resolvedForeignKeys);

        // Build query dynamically for the main table
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($query);

        // Bind values
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }

        // Execute the main query and return success status
        return $stmt->execute();
    }

    // Resolve foreign key dynamically
    private function resolveForeignKey($table, $data, $primaryKey) {
        // Check if the foreign key record exists
        $columns = implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $query = "SELECT $primaryKey FROM $table WHERE $columns LIMIT 1";
        $stmt = $this->db->prepare($query);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }
        $stmt->execute();

        $existingRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingRecord) {
            // Return the existing primary key
            return $existingRecord[$primaryKey];
        } else {
            // Insert a new record and return the new primary key
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($query);

            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
            }
            $stmt->execute();
            return $this->db->lastInsertId();
        }
    }
}