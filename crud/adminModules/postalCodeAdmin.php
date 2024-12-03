<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// Get postal codes
$queryPostalCode = $dbCon->prepare("SELECT * FROM PostalCode");
$queryPostalCode->execute();
$getPostalCode = $queryPostalCode->fetchAll();
?>

<!-- Postal Code -->
<div class="container">
    <h4>All Postal codes + their city</h4>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The postal code has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The postal code has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new postal code has been successfully added!";
            echo "<script>M.toast({html: 'Added!'})</script>";
        } elseif ($_GET['status'] == 0) {
            echo "Forbidden access - redirected to home!";
            echo "<script>M.toast({html: 'Access denied!'})</script>";
        }
    }
    ?>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>PostalCode</th>
                <th>City</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getPostalCode)) {
                $getPostalCode = [];
            }

            foreach ($getPostalCode as $postalCode) {
                echo "<tr>";
                echo "<td>" . $postalCode['PostalCode'] . "</td>";
                echo "<td>" . $postalCode['City'] . "</td>";
                echo '<td><a href="index.php?page=editpostalcode&ID=' . $postalCode['PostalCode'] . '" class="btn">Edit</a></td>';
                echo '<td><a href="index.php?page=deletepostalcode&PostalCode=' . $postalCode['PostalCode'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Postal Code</h4>

    <form class="col s12" name="contact" method="post" action="crud/postalCode/addPostalCode.php">
        <div class="row">
            <div class="input-field col s6">
                <input id="PostalCode" name="PostalCode" type="text" class="validate" required="" aria-required="true">
                <label for="PostalCode">PostalCode</label>
            </div>

            <div class="input-field col s6">
                <input id="City" name="City" type="text" class="validate" required="" aria-required="true">
                <label for="City">City</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>