<?php
class UpdateModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // updates in the database with primary keys
    private function getPrimaryKey($table) {
        // fetch the primary key of the given table
        $query = "SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // return the column name of the primary key
        return $result['Column_name'] ?? null;
    }

    // updates in the database with primary keys and foreign keys
    public function updateWithCompositeKey($table, $originalKeys, $data, $foreignKeys = []) {
        $resolvedForeignKeys = [];

        // validate and remove CSRF token from database
        if (isset($data['csrf_token'])) {
            unset($data['csrf_token']); 
        }
    
        // resolve foreign keys to ensure they exist in the database
        foreach ($foreignKeys as $foreignKey => $config) {
            $resolvedForeignKeys[$config['primaryKey']] = $this->resolveForeignKey(
                $config['table'],
                $config['data'],
                $config['primaryKey']
            );
        }
    
        // merge resolved foreign keys into the main data
        $data = array_merge($data, $resolvedForeignKeys);
    
        // ensure at least one primary key is provided
        if (empty($originalKeys)) {
            throw new Exception("No primary keys provided for the WHERE clause in the update query.");
        }
    
        // columns: column1 = :column1, column2 = :column2
        $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
    
        // foreign keys: key1 = :original_key1 AND key2 = :original_key2
        $whereClause = implode(" AND ", array_map(fn($key) => "$key = :original_$key", array_keys($originalKeys)));
    
        // update table
        $query = "UPDATE $table SET $setClause WHERE $whereClause";
    
        $stmt = $this->db->prepare($query);
    
        // bind values being updated
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }
    
        // bind original keys in the data
        foreach ($originalKeys as $key => $value) {
            $stmt->bindValue(":original_$key", htmlspecialchars(trim($value)));
        }
    
        return $stmt->execute();
    }

    // resolves a foreign key by checking if the data exists
    // if not, it inserts the data
    private function resolveForeignKey($table, $data, $primaryKey) {
        // check if the foreign key data exists
        $columns = implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($data)));

        $query = "SELECT $primaryKey FROM $table WHERE $columns LIMIT 1";

        $stmt = $this->db->prepare($query);

        // loop through the data and bind values
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }
        $stmt->execute();

        // return the primary key if the data exists
        $existingRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        // if it exists return the primary key
        if ($existingRecord) {
            return $existingRecord[$primaryKey];
        } else {
            // insert new for the foreign key
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($query);

            // bind values for the insert query
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
            }
            $stmt->execute();
            return $this->db->lastInsertId();
        }
    }
}