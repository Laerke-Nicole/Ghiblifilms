<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/session.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
		if (logged_in()) {
		redirect_to("index.php");
	}
 ?>


<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
    <title>Log in</title>
</head>
<body>
<?php
    // START FORM PROCESSING
    if (isset($_POST['submit'])) { // Form has been submitted.
        $username = trim($_POST['User']);
        $password = trim($_POST['Pass']);
        
        try {
            // Prepare the SQL query using PDO
            $query = "SELECT UserID, Username, Pass FROM User WHERE Username = :Username LIMIT 1"; // Use 'username' instead of 'user'
            $stmt = $connection->prepare($query);
            
            // Bind the username parameter
            $stmt->bindParam(':Username', $username);
            $stmt->execute();
            
            // Fetch the result
            $found_user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($found_user) {
                // Check if the user is an admin
                if ($username == "admin" && $password == "123456") {
                    $_SESSION['user_id'] = $found_user['UserID'];
                    $_SESSION['User'] = $found_user['Username'];
                    redirect_to("index.php?page=admin");
                } else {
                    // Check if the password matches for non-admin users
                    if (password_verify($password, $found_user['Pass'])) {
                        // Username/password authenticated
                        $_SESSION['user_id'] = $found_user['UserID'];
                        $_SESSION['User'] = $found_user['Username'];
                        redirect_to("index.php");
                    } else {
                        // Password is incorrect
                        $message = "Username/password combination incorrect.<br />
                        Please make sure your caps lock key is off and try again.";
                    }
                }
            } else {
                // No user found
                $message = "Username/password combination incorrect.<br />
                Please make sure your caps lock key is off and try again.";
            }
        } catch (PDOException $e) {
            die("Database query failed: " . $e->getMessage());
        }
    } else { // Form has not been submitted.
        if (isset($_GET['logout']) && $_GET['logout'] == 1) {
            $message = "You are now logged out.";
        } 
    }
    
    // Display the message if set
    if (!empty($message)) {
        echo "<p>" . $message . "</p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ghiblifilms</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/library.css">
    <link rel="stylesheet" href="style/responsive.css">
    <link rel="stylesheet" href="https://use.typekit.net/arj0iay.css">
</head>

<h2>Log in</h2>

<form action="" method="post" class="flex flex-col">
    <div class="pb-4">
        <p>Username:</p>
        <input type="text" name="User" maxlength="30" value="" />
    </div>
    
    <div class="pb-4">
        <p>Password:</p>
        <input type="password" name="Pass" maxlength="30" value="" />
    </div>

    <div class="cursor">
        <input type="submit" name="submit" value="Login" class="btn" />
    </div>
</form>

<button class="g-recaptcha" 
        data-sitekey="6Le5im4qAAAAABvcp4E5XaeQ54PjcD-9ql3pq5nF" 
        data-callback='onSubmit' 
        data-action='submit'>Submit</button>


<!-- recaptcha -->
<script src="https://www.google.com/recaptcha/api.js"></script>

<script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
</script>

</body>
</html>
<?php
if (isset($connection)){$connection = null;}
?>