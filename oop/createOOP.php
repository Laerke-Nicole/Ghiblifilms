<?php
class CreateModel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    // insert data into the database
    public function create($table, $data, $foreignKeys = []) {
        $resolvedForeignKeys = [];

        // validate and remove CSRF token from database
        if (isset($data['csrf_token'])) {
            unset($data['csrf_token']); 
        }

        // make sure the data exist in their tables
        foreach ($foreignKeys as $foreignKey => $config) {
            // check if the related data exists if it doesnt it will create it
            $resolvedForeignKeys[$config['primaryKey']] = $this->resolveForeignKey(
                $config['table'],
                $config['data'],
                $config['primaryKey']
            );
        }

        // merge resolved foreign keys into the main data array
        $data = array_merge($data, $resolvedForeignKeys);

        // keys of the $column name
        $columns = implode(", ", array_keys($data));
        // :column1, :column2
        $placeholders = ":" . implode(", :", array_keys($data));

        // insert data into the database
        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->db->prepare($query);

        // bind the data
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }

        // execute the insert query
        return $stmt->execute();
    }

    // check a foreign key exists in the database
    private function resolveForeignKey($table, $data, $primaryKey) {
        // check if the foreign key exists
        $columns = implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $query = "SELECT $primaryKey FROM $table WHERE $columns LIMIT 1";
        $stmt = $this->db->prepare($query);

        // bind the data 
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
        }
        $stmt->execute();

        // fetch the data if it exists
        $existingRecord = $stmt->fetch(PDO::FETCH_ASSOC);

        // if the foreign key exists
        if ($existingRecord) {
            // return the existing primary key
            return $existingRecord[$primaryKey];
        } else {
            // if the data does not exist insert it into the foreign table
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));

            // insert into table
            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($query);

            // bind the data
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", htmlspecialchars(trim($value)));
            }

            // execute the insert query
            $stmt->execute();

            // return the primary key of the new inserted data
            return $this->db->lastInsertId();
        }
    }
}