<?php
class DeleteModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function delete($table, $primaryKey, $primaryKeyValue) {
        $query = "DELETE FROM $table WHERE $primaryKey = :primaryKeyValue";
        $stmt = $this->db->prepare($query);

        // Bind the primary key value
        $stmt->bindValue(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_INT);

        return $stmt->execute();
    }
}