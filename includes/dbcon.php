<?php
$user = "root";
$pass = "";
function dbCon($user, $pass){
    try {
        $dbCon = new PDO('mysql:host=localhost;dbname=ghiblifilmsdb;charset=utf8', $user, $pass);
        return $dbCon;
    } catch (PDOException $err) {
        echo "Error!: " . $err->getMessage() . "<br/>";
        die();
    }
}

