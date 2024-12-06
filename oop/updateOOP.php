<?php
class UpdateModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function update($table, $primaryKey, $id, $data, $foreignKeys = []) {
        $resolvedForeignKeys = [];

        // Handle foreign keys dynamically
        foreach ($foreignKeys as $foreignKey => $config) {
            $resolvedForeignKeys[$config['primaryKey']] = $this->resolveForeignKey(
                $config['table'],
                $config['data'],
                $config['primaryKey']
            );
        }

        // Merge resolved foreign keys into the main data
        $data = array_merge($data, $resolvedForeignKeys);

        // Build query dynamically
        $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));

        $query = "UPDATE $table SET $setClause WHERE $primaryKey = :id";
        $stmt = $this->db->prepare($query);

        // Bind values
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }
        $stmt->bindValue(":id", $id);

        // Execute and return success status
        return $stmt->execute();
    }

    private function resolveForeignKey($table, $data, $primaryKey) {
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
