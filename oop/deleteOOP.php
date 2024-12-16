<?php
class DeleteModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function delete($table, $primaryKey, $primaryKeyValue) {
        // delete table where primary key is equal to primary key value
        $query = "DELETE FROM $table WHERE $primaryKey = :primaryKeyValue";
        
        $stmt = $this->db->prepare($query);

        // bind the primary key value
        $stmt->bindValue(':primaryKeyValue', $primaryKeyValue, PDO::PARAM_INT);

        return $stmt->execute();
    }
}