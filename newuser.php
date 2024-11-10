<?php require_once("includes/session.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php //confirm_logged_in(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New user</title>
</head>


<?php
if (isset($_POST['submit'])) {

	$username = trim($_POST['user']);
	$password = trim($_POST['pass']);

    // check if username already exists
    $query = "SELECT COUNT(*) FROM UserLogin WHERE Username = :username";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
	
    // fetch the count of usernames found
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // if username already exists
        $message = "The username '{$username}' is taken. Please choose a different username.";
    } else {

        // hash the password
        $iterations = ['cost' => 15];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

        try {
            $query = "INSERT INTO UserLogin (username, pass) VALUES (:username, :hashed_password)";
            $stmt = $connection->prepare($query);

            // bind parameters
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':hashed_password', $hashed_password);

            $result = $stmt->execute();

            if ($result) {
                $message = "User Created.";
                redirect_to("index.php?page=login");
            } else {
                $message = "User could not be created.";
            }
        } catch (PDOException $e) {
            $message = "User could not be created. Error: " . $e->getMessage();
        }
    }
}

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

<h2>Create New User</h2>

<form action="" method="post" class="flex flex-col">
    <div class="pb-4">
        <p>Username:</p>
        <input type="text" name="user" maxlength="30" value="" />
    </div>
    
    <div class="pb-4">
        <p>Password:</p>
        <input type="password" name="pass" maxlength="30" value="" />
    </div>

    <div class="cursor">
        <input type="submit" name="submit" value="Create" class="btn" />
    </div>

    <div>
        <a href="index.php?page=login" class="secondary-color">Aldready got a user? Log in here</a>
    </div>
</form>

</body>
</html>

<?php
if (isset($connection)){$connection = null;}
?>