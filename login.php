<?php 
require_once("includes/connection.php"); 
require_once("includes/session.php"); 
require_once("includes/functions.php"); 


if (logged_in()) {
    redirect_to("index.php?page=home");
}


$recaptchaSecret = '6Le5im4qAAAAAIilBJ35BlmkGIPIjIh-m5LgXR0u';
$recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';

if (!$recaptchaResponse) {
    echo "reCAPTCHA token is missing. Please try again.";
    exit;
}

// Verify the token
$recaptchaValidation = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecret&response=$recaptchaResponse");
$recaptchaData = json_decode($recaptchaValidation);

if (!$recaptchaData->success) {
    echo "reCAPTCHA validation failed. Please try again.";
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
        
        if ($found_user) {
            if (password_verify($password, $found_user['Pass'])) {                                          
                // check if the password matches for non-admin users
                if (password_verify($password, $found_user['Pass'])) {
                    // username/password authenticated
                    $_SESSION['UserID'] = $found_user['UserID'];
                    $_SESSION['User'] = $found_user['Username'];
                    redirect_to("index.php?page=successfullogindetail");
                } else {
                    // if password is incorrect
                    $message = "Username/password combination incorrect.<br />
                    Please make sure your caps lock key is off and try again.";
                }
            }
        } else {
            // if no user found
            $message = "Username/password combination incorrect.<br />
            Please make sure your caps lock key is off and try again.";
        }
    } catch (PDOException $e) {
        die("Database query failed: " . $e->getMessage());
    }
} 

// display the message if set
if (!empty($message)) {
    echo "<p>" . $message . "</p>";
}


// display the log in form
include ("views/loginDetail.php");


// close the connection
if (isset($connection)){$connection = null;}
?>