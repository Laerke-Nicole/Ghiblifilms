<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// Get users
$queryUser = $dbCon->prepare("SELECT * FROM User");
$queryUser->execute();
$getUsers = $queryUser->fetchAll();
//var_dump($getUsers);
?>


<!-- user -->
<div class="container">

    <h2>All users</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The user " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The user " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new user has been successfully added!";
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
                <tr class="secondary-color">
                    <th>UserID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Address</th>
                    <th>Postal code</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody class="secondary-color">
                <?php
                if (!isset($getUsers)) {
                    $getUsers = [];
                }
                
                foreach ($getUsers as $getUser) {
                    echo "<tr>";
                    echo "<td>". $getUser['UserID']."</td>";
                    echo "<td>". $getUser['FirstName']. " " .$getUser['LastName']."</td>";
                    echo "<td>". $getUser['Email']."</td>";
                    echo "<td>". $getUser['PhoneNumber']."</td>";
                    echo "<td>". $getUser['Address']."</td>";
                    echo "<td>". $getUser['PostalCode']."</td>";
                    echo "<td>";

                    echo "</td>";
                    echo '<td><a href="index.php?page=edituser&ID='.$getUser['UserID'].'" class="btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deleteuser&UserID='.$getUser['UserID'].'" class=" btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                    
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>



        <hr>
        <h3>Add new user</h3>

        <form class="col s12" name="contact" method="post" action="crud/user/addUser.php">
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
                    <input id="PostalCode" name="PostalCode" type="number" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal code</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
        </form>
    </div>
</div>