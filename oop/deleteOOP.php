<?php
class DeleteModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // Generic delete method
    public function delete($table, $primaryKey, $id) {
        // Use a prepared statement for safety
        $query = "DELETE FROM $table WHERE $primaryKey = :id";
        $stmt = $this->db->prepare($query);
        
        // Bind the ID value to prevent SQL injection
        $stmt->bindParam(':id', $id);

        // Execute the query and return success status
        return $stmt->execute();
    }
}