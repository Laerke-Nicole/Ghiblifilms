    <?php 
    require_once("includes/session.php"); 
    require_once("includes/connection.php"); 
    require_once("includes/functions.php"); 
    require_once ("includes/csrfProtection.php");

// make address not be duplicated
function resolveAddress($dbCon, $streetName, $streetNumber, $postalCode, $country) {
    // check if the address exists
    $query = $dbCon->prepare("
        SELECT AddressID 
        FROM Address 
        WHERE StreetName = :streetName 
          AND StreetNumber = :streetNumber 
          AND PostalCode = :postalCode 
          AND Country = :country
        LIMIT 1
    ");
    $query->bindParam(':streetName', $streetName);
    $query->bindParam(':streetNumber', $streetNumber);
    $query->bindParam(':postalCode', $postalCode);
    $query->bindParam(':country', $country);
    $query->execute();

    $existingAddress = $query->fetch();

    if ($existingAddress) {
        // return the existing AddressID
        return $existingAddress['AddressID'];
    } else {
        // create a new address and return the new AddressID
        $query = $dbCon->prepare("
            INSERT INTO Address (StreetName, StreetNumber, PostalCode, Country) 
            VALUES (:streetName, :streetNumber, :postalCode, :country)
        ");
        $query->bindParam(':streetName', $streetName);
        $query->bindParam(':streetNumber', $streetNumber);
        $query->bindParam(':postalCode', $postalCode);
        $query->bindParam(':country', $country);
        $query->execute();

        return $dbCon->lastInsertId();
    }
}

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

    // Tjek om brugernavnet allerede findes
    $query = "SELECT COUNT(*) FROM User WHERE Username = :username";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Hent antallet af eksisterende brugernavne
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Hvis brugernavnet allerede findes
        $message = "The username '{$username}' is taken. Please choose a different username.";
    } else {
        // Hash password
        $iterations = ['cost' => 15];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $iterations);

        try {
            // Brug resolveAddress til at finde eller oprette AddressID
            $addressID = resolveAddress($connection, $streetName, $streetNumber, $postalCode, $country);

            // Indsæt brugeren i databasen
            $query = "INSERT INTO User (Username, Pass, FirstName, LastName, Email, PhoneNumber, AddressID) 
                      VALUES (:username, :hashed_password, :firstName, :lastName, :email, :phoneNumber, :addressID)";
            $stmt = $connection->prepare($query);

            // Bind parametre
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
                    if (!headers_sent()) {
                        header("Location: /index.php?page=login");
                        exit;
                    } else {
                        echo "<script>window.location.href='/index.php?page=login';</script>";
                        exit;
                    }
                } else {
                    $message = "User could not be created.";
                }
            } catch (PDOException $e) {
                $message = "User could not be created. Error: " . $e->getMessage();
            }
        }
    }

    // display the message if set
    if (!empty($message)) {
        echo "<p>" . $message . "</p>";
    }

    // display the new user form
    include ("views/newUserDetail.php");

    // close the connection
    if (isset($connection)){$connection = null;} 
    ?>