<?php 
require_once("includes/session.php"); 
require_once("includes/connection.php"); 
require_once("includes/functions.php"); 


if (isset($_POST['submit'])) {

	$username = htmlspecialchars(trim($_POST['Username']));
	$password = htmlspecialchars(trim($_POST['Pass']));
    $firstName = htmlspecialchars(trim($_POST['FirstName']));
    $lastName = htmlspecialchars(trim($_POST['LastName']));
    $email = htmlspecialchars(trim($_POST['Email']));
    $phoneNumber = htmlspecialchars(trim($_POST['PhoneNumber']));
    $streetName = htmlspecialchars(trim($_POST['StreetName']));
    $streetNumber = htmlspecialchars(trim($_POST['StreetNumber']));
    $postalCode = htmlspecialchars(trim($_POST['PostalCode']));
    $country = htmlspecialchars(trim($_POST['Country']));

    // check if username already exists
    $query = "SELECT COUNT(*) FROM User WHERE Username = :username";
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
            // first insert the address
            $queryAddress = $connection->prepare("INSERT INTO Address (StreetName, StreetNumber, PostalCode, Country) 
                                            VALUES (:streetName, :streetNumber, :postalCode, :country)");
            $queryAddress->bindParam(':streetName', $streetName);
            $queryAddress->bindParam(':streetNumber', $streetNumber);
            $queryAddress->bindParam(':postalCode', $postalCode);
            $queryAddress->bindParam(':country', $country);
            $queryAddress->execute();

            // get the last inserted AddressID
            $addressID = $connection->lastInsertId();


            $query = "INSERT INTO User (Username, Pass, FirstName, LastName, Email, PhoneNumber, AddressID) VALUES (:username, :hashed_password, :firstName, :lastName, :email, :phoneNumber, :addressID)";
            $stmt = $connection->prepare($query);

            // bind parameters
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':hashed_password', $hashed_password);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phoneNumber', $phoneNumber);
            $stmt->bindParam(':addressID', $addressID);

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
    <title>New user</title>
</head>

<h2>Create New User</h2>

<form action="" method="post" class="flex flex-col">
    <div class="pb-4">
        <p>Username:</p>
        <input type="text" name="Username" maxlength="50" value="" class="validate" required="" aria-required="true" />
    </div>
    
    <div class="pb-4">
        <p>Password:</p>
        <input type="password" name="Pass" maxlength="255" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>First name:</p>
        <input type="text" name="FirstName" maxlength="50" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Last name:</p>
        <input type="text" name="LastName" maxlength="50" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Email:</p>
        <input type="text" name="Email" maxlength="255" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Phone number:</p>
        <input type="text" name="PhoneNumber" maxlength="20" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Street name:</p>
        <input type="text" name="StreetName" maxlength="255" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Street number:</p>
        <input type="number" name="StreetNumber" maxlength="10" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Postal code:</p>
        <input type="text" name="PostalCode" maxlength="10" value="" class="validate" required="" aria-required="true" />
    </div>

    <div class="pb-4">
        <p>Country:</p>
        <input type="text" name="Country" maxlength="150" value="" class="validate" required="" aria-required="true" />
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

<?php if (isset($connection)){$connection = null;} ?>