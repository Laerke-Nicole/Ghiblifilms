<?php
class UpdateModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function updateWithCompositeKey($table, $originalKeys, $data, $foreignKeys = []) {
        $resolvedForeignKeys = [];
    
        // Resolve foreign keys dynamically
        foreach ($foreignKeys as $foreignKey => $config) {
            $resolvedForeignKeys[$config['primaryKey']] = $this->resolveForeignKey(
                $config['table'],
                $config['data'],
                $config['primaryKey']
            );
        }
    
        // Merge resolved foreign keys into the main data
        $data = array_merge($data, $resolvedForeignKeys);
    
        // Ensure originalKeys are provided
        if (empty($originalKeys)) {
            throw new Exception("No primary keys provided for the WHERE clause in the update query.");
        }
    
        // Build SET clause dynamically
        $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
    
        // Build WHERE clause for composite keys
        $whereClause = implode(" AND ", array_map(fn($key) => "$key = :original_$key", array_keys($originalKeys)));
    
        // Final Query
        $query = "UPDATE $table SET $setClause WHERE $whereClause";
    
        // Debugging
        error_log("Generated Query: $query");
        error_log("Data: " . print_r($data, true));
        error_log("Original Keys: " . print_r($originalKeys, true));
    
        $stmt = $this->db->prepare($query);
    
        // Bind values for SET clause
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }
    
        // Bind values for WHERE clause
        foreach ($originalKeys as $key => $value) {
            $stmt->bindValue(":original_$key", htmlspecialchars(trim($value)));
        }
    
        // Execute and return success status
        return $stmt->execute();
    }

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
            return $existingRecord[$primaryKey];
        } else {
            // Insert new record for the foreign key
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