<?php 
require_once("includes/connection.php"); 
require_once("includes/session.php"); 
require_once("includes/functions.php"); 
require_once ("csrfProtection.php");


if (logged_in()) {
    // redirect_to("index.php?page=home");
    header("Location: index.php?page=home");
    exit;
}

if (isset($_POST['submit'])) { 
    $username = trim($_POST['User']);
    $password = trim($_POST['Pass']);
    
    try {
        $query = "SELECT UserID, Username, Pass FROM User WHERE Username = :Username LIMIT 1"; 
        $stmt = $connection->prepare($query);
        
        // bind the username parameter
        $stmt->bindParam(':Username', $username);
        $stmt->execute();
        
        $found_user = $stmt->fetch();
        
        if ($found_user && password_verify($password, $found_user['Pass'])) {
            // username/password authenticated
            $_SESSION['UserID'] = $found_user['UserID'];
            $_SESSION['User'] = $found_user['Username'];
        
            // after logging in go to the successful login detail view
            if (!headers_sent()) {
                header("Location: /index.php?page=useroptions");
                exit;
            } else {
                echo "<script>window.location.href='/index.php?page=useroptions';</script>";
                exit;
            }
        } else {
            // if username or password is incorrect
            $message = "Username/password combination incorrect.<br />
            Please make sure your caps lock key is off and try again.";
        }        
    } catch (PDOException $e) {
        die("Database query failed: " . $e->getMessage());
    }
}

// display the message if set
if (!empty($message)) {
    echo "<p>" . htmlspecialchars(trim($message)) . "</p>";
}


// display the log in form
include ("views/loginDetail.php");


// close the connection
if (isset($connection)){$connection = null;}