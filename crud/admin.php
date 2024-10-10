<?php require_once "dbcon.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin page</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<?php
$dbCon = dbCon($user, $pass);
$query = $dbCon->prepare("SELECT * FROM User");
$query->execute();
$getUsers = $query->fetchAll();
//var_dump($getUsers);


?>
<body>

<div class="container">

    <h2>All users</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The entry " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The entry " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new entry has been successfully added!";
            echo "<script>M.toast({html: 'Added!'})</script>";
        } elseif ($_GET['status'] == 0) {
            echo "Forbidden access - redirected to home!";
            echo "<script>M.toast({html: 'Access denied!'})</script>";
        }
    }
    ?>
    <div class="row">
        <div class="row">
            <table class="highlight">
                <thead>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>Postal code</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody>
                <?php
                foreach ($getUsers as $getUser) {
                    echo "<tr>";
                    echo "<td>". $getUser['UserID']."</td>";
                    echo "<td>". $getUser['Username']."</td>";
                    echo "<td>". $getUser['FirstName']. " " .$getUser['LastName']."</td>";
                    echo "<td>". $getUser['Email']."</td>";
                    echo "<td>". $getUser['PhoneNumber']."</td>";
                    echo "<td>". $getUser['Address']."</td>";
                    echo "<td>". $getUser['PostalCode']."</td>";
                    echo "<td>";

                    echo "</td>";
                    echo '<td><a href="editEntry.php?ID='.$getUser['UserID'].'" class="waves-effect waves-light btn" ">Edit</a></td>';
                    echo '<td><a href="deleteEntry.php?UserID='.$getUser['UserID'].'" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';

                    
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <hr>
        <h3>Add new user</h3>

        <form class="col s12" name="contact" method="post" action="addEntry.php">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Username" name="Username" type="text" class="validate" required="" aria-required="true">
                    <label for="Username">Username</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s6">
                    <input id="FirstName" name="FirstName" type="text" class="validate" required="" aria-required="true">
                    <label for="FirstName">First Name</label>
                </div>
                
                <div class="input-field col s6">
                    <input id="LastName" name="LastName" type="text" class="validate" required="" aria-required="true">
                    <label for="LastName">Last Name</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s6">
                        <input id="Email" name="Email" type="email" class="validate" required="" aria-required="true">
                        <label for="Email">E-Mail</label>
                    </div>

                    <div class="input-field col s6">
                        <input id="PhoneNumber" name="PhoneNumber" type="number" class="validate" required="" aria-required="true">
                        <label for="PhoneNumber">Phone number</label>
                    </div>
                </div>  
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="Address" name="Address" type="text" class="validate" required="" aria-required="true">
                    <label for="Address">Address</label>
                </div>

                <div class="input-field col s6">
                    <input id="PostalCode" name="PostalCode" type="text" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>
            </div>






            <!-- <div class="row">
                <div class="input-field col s12">
                    <textarea name="Description" id="description" class="materialize-textarea" required="" aria-required="true"></textarea>
                    <label for="Description">Description</label>
                </div>
            </div> -->


            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
        </form>
    </div>
</div>
</body>
</html>