<?php 
require_once("includes/connection.php"); 
require_once("includes/session.php"); 
require_once("includes/functions.php"); 
require_once ("includes/csrfProtection.php");

// check if the user is already logged in
if (logged_in()) {
    header("Location: index.php?page=home");
    exit;
}

// if login btn has been clicked
if (isset($_POST['submit'])) { 
    // get the input fields
    $username = htmlspecialchars(trim($_POST['User']));
    $password = htmlspecialchars(trim($_POST['Pass']));
    
    // check if the username and password are correct
    try {
        $query = "SELECT UserID, Username, Pass, Role FROM User WHERE Username = :Username LIMIT 1"; 
        $stmt = $connection->prepare($query);
        
        // bind the username parameter
        $stmt->bindParam(':Username', $username);
        $stmt->execute();
        
        $found_user = $stmt->fetch();
        
        if ($found_user && password_verify($password, $found_user['Pass'])) {
            // username/password authenticated
            $_SESSION['UserID'] = $found_user['UserID'];
            $_SESSION['User'] = $found_user['Username'];
            $_SESSION['Role'] = $found_user['Role'];
        
            // after logging in go to the successful login detail view
            if ($found_user['Role'] === 'Admin') {
                echo "<script>window.location.href='/index.php?page=admin';</script>";
                exit;
            } else {
                // if user is logged in go to the user options page
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