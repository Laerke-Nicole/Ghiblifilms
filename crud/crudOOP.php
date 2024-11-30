<?php

class CRUD
{
    private $dbCon;

    public function __construct($dbCon)
    {
        $this->dbCon = $dbCon;
    }

    public function getPrimaryKey()
    {
        $query = $this->dbCon->prepare("SHOW KEYS FROM {$this->table} WHERE Key_name = 'PRIMARY'");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result['Column_name'] ?? null;
    }

    // create
    public function create($table, array $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $query = $this->dbCon->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");

        foreach ($data as $key => $value) {
            $query->bindValue(":$key", htmlspecialchars(trim($value)));
        }

        return $query->execute();
    }

    // read
    public function read($table, array $conditions = [])
    {
        $sql = "SELECT * FROM $table";
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        }
        $query = $this->dbCon->prepare($sql);

        foreach ($conditions as $key => $value) {
            $query->bindValue(":$key", htmlspecialchars(trim($value)));
        }

        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // update
    public function update($table, array $data, array $conditions)
    {
        $setClause = implode(", ", array_map(fn($key) => "$key = :$key", array_keys($data)));
        $whereClause = implode(" AND ", array_map(fn($key) => "$key = :where_$key", array_keys($conditions)));
        $query = $this->dbCon->prepare("UPDATE $table SET $setClause WHERE $whereClause");

        foreach ($data as $key => $value) {
            $query->bindValue(":$key", htmlspecialchars(trim($value)));
        }

        foreach ($conditions as $key => $value) {
            $query->bindValue(":where_$key", htmlspecialchars(trim($value)));
        }

        return $query->execute();
    }

    // delete
    public function delete($table, array $conditions)
    {
        $whereClause = implode(" AND ", array_map(fn($key) => "$key = :$key", array_keys($conditions)));
        $query = $this->dbCon->prepare("DELETE FROM $table WHERE $whereClause");

        foreach ($conditions as $key => $value) {
            $query->bindValue(":$key", htmlspecialchars(trim($value)));
        }

        return $query->execute();
    }
}
?>