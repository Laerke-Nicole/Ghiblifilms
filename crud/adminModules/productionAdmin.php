<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// Get opening hours
$queryProduction = $dbCon->prepare("SELECT * FROM Production");
$queryProduction->execute();
$getProduction = $queryProduction->fetchAll();
?>

<!-- Production -->
<div class="container">
    <h2>All Production</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The production has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The production has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new production has been successfully added!";
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
                <th>ProductionID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>RoleInProductionID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getProduction)) {
                $getProduction = [];
            }

            foreach ($getProduction as $production) {
                echo "<tr>";
                    echo "<td>" . $production['ProductionID'] . "</td>";
                    echo "<td>" . $production['FirstName'] . "</td>";
                    echo "<td>" . $production['LastName'] . "</td>";
                    echo "<td>" . $production['RoleInProductionID'] . "</td>";
                    echo '<td><a href="index.php?page=editproduction&ID=' . $production['ProductionID'] . '" class="btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deleteproduction&ProductionID=' . $production['ProductionID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h3>Add New Production</h3>

    <form class="col s12" name="contact" method="post" action="crud/production/addProduction.php">
        <div class="row">
            <div class="input-field col s6">
                <input id="FirstName" name="FirstName" type="text" class="validate" required="" aria-required="true">
                <label for="FirstName">FirstName</label>
            </div>

            <div class="input-field col s6">
                <input id="LastName" name="LastName" type="text" class="validate" required="" aria-required="true">
                <label for="LastName">LastName</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input id="RoleInProductionID" name="RoleInProductionID" type="text" class="validate" required="" aria-required="true">
                <label for="RoleInProductionID">RoleInProductionID</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>