<?php
confirm_logged_in();

// Get opening hours
$queryRoleInProduction = $dbCon->prepare("SELECT * FROM RoleInProduction");
$queryRoleInProduction->execute();
$getRoleInProduction = $queryRoleInProduction->fetchAll();
?>

<!-- Role In Production -->
<div class="container">
    <h4>All Role In Production</h4>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The role in production has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The role in production has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new role in production has been successfully added!";
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
                <th>RoleInProductionID</th>
                <th>NameOfRole</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getRoleInProduction)) {
                $getRoleInProduction = [];
            }

            foreach ($getRoleInProduction as $role) {
                echo "<tr>";
                    echo "<td>" . $role['RoleInProductionID'] . "</td>";
                    echo "<td>" . $role['NameOfRole'] . "</td>";
                    echo '<td><a href="index.php?page=editroleinproduction&ID=' . $role['RoleInProductionID'] . '" class="btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deleteroleinproduction&RoleInProductionID=' . $role['RoleInProductionID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Role In Production</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="RoleInProduction">
        <div class="row">
            <div class="input-field col s12">
                <input id="NameOfRole" name="NameOfRole" type="text" class="validate" required="" aria-required="true">
                <label for="NameOfRole">NameOfRole</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>