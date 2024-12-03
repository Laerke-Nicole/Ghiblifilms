<?php
$user = "cb26w5b3u_ghiblifilmsdb";
$pass = "WebDev123";
function dbCon($user, $pass){
    try {
        $dbCon = new PDO('mysql:host=localhost;dbname=cb26w5b3u_ghiblifilmsdb;charset=utf8', $user, $pass);
        return $dbCon;
    } catch (PDOException $err) {
        echo "Error!: " . $err->getMessage() . "<br/>";
        die();
    }
}

// connect to db
$dbCon = dbCon($user, $pass);