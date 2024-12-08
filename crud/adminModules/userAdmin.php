<?php
confirm_logged_in();

// get users with address details
$queryUser = $dbCon->prepare("SELECT U.*, A.StreetName, A.StreetNumber, A.PostalCode, A.Country 
                                FROM User U 
                                LEFT JOIN Address A ON U.AddressID = A.AddressID");

$queryUser->execute();
$getUsers = $queryUser->fetchAll();
?>


<!-- user -->
<div class="container">

    <h4>All users</h4>
    <div class="row">
        <div class="row">
            <table class="highlight">
                <thead>
                <tr class="secondary-color">
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Street name</th>
                    <th>Street number</th>
                    <th>Postal code</th>
                    <th>Country</th>

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
                    echo "<td>". htmlspecialchars(trim($getUser['UserID']))."</td>";
                    echo "<td>". htmlspecialchars(trim($getUser['Username']))."</td>";
                    echo "<td>". htmlspecialchars(trim($getUser['FirstName'])). " " . htmlspecialchars(trim($getUser['LastName']))."</td>";
                    echo "<td>". htmlspecialchars(trim($getUser['Email']))."</td>";
                    echo "<td>". htmlspecialchars(trim($getUser['PhoneNumber']))."</td>";
                    echo "<td>". htmlspecialchars(trim($getUser['StreetName']))."</td>";
                    echo "<td>". htmlspecialchars(trim($getUser['StreetNumber']))."</td>";
                    echo "<td>". htmlspecialchars(trim($getUser['PostalCode']))."</td>";
                    echo "<td>". htmlspecialchars(trim($getUser['Country']))."</td>";
                    echo "<td>";

                    echo "</td>";
                    echo '<td><a href="index.php?page=edituser&ID=' . htmlspecialchars(trim($getUser['UserID'])) . '" class="btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deleteuser&UserID=' . htmlspecialchars(trim($getUser['UserID'])) . '" class=" btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';
                    
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>



        <hr>
        <h4>Add new user</h3>

        <form class="col s12" name="contact" method="post" action="controllers/create.php">
            <!-- to tell create.php which table to insert data into -->
            <input type="hidden" name="table" value="User">
            <div class="row">
                <div class="input-field col s6">
                    <input id="Username" name="Username" type="text" class="validate" required="" aria-required="true">
                    <label for="Username">Username</label>
                </div>

                <div class="input-field col s6">
                    <input id="Pass" name="Pass" type="password" class="validate" required="" aria-required="true" />
                    <label for="Pass">Password</label>
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
                    <input id="StreetName" name="fk_Address_StreetName" type="text" class="validate" required="" aria-required="true">
                    <label for="StreetName">Street Name</label>
                </div>

                <div class="input-field col s6">
                    <input id="StreetNumber" name="fk_Address_StreetNumber" type="number" class="validate" required="" aria-required="true">
                    <label for="StreetNumber">Street Number</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s6">
                    <input id="PostalCode" name="fk_Address_PostalCode" type="text" class="validate" required="" aria-required="true">
                    <label for="PostalCode">Postal Code</label>
                </div>
                
                <div class="input-field col s6">
                    <input id="Country" name="fk_Address_Country" type="text" class="validate" required="" aria-required="true">
                    <label for="Country">Country</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add
            </button>
        </form>
    </div>
</div>