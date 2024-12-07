<?php
confirm_logged_in();

// Get opening hours
$queryProduction = $dbCon->prepare("SELECT * FROM Production");
$queryProduction->execute();
$getProduction = $queryProduction->fetchAll();
?>

<!-- Production -->
<div class="container">
    <h4>All Production</h4>
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
                    echo "<td>" . htmlspecialchars(trim($production['ProductionID'])) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($production['FirstName'])) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($production['LastName'])) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($production['RoleInProductionID'])) . "</td>";
                    echo '<td><a href="index.php?page=editproduction&ID=' . htmlspecialchars(trim($production['ProductionID'])) . '" class="btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deleteproduction&ProductionID=' . htmlspecialchars(trim($production['ProductionID'])) . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Production</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="Production">
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