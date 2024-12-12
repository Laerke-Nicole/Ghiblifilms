<?php
confirm_logged_in();
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
            <?php foreach ($getProduction as $production): ?>
                <tr>
                    <td><?php echo htmlspecialchars(trim($production['ProductionID'])); ?></td>
                    <td><?php echo htmlspecialchars(trim($production['FirstName'])); ?></td>
                    <td><?php echo htmlspecialchars(trim($production['LastName'])); ?></td>
                    <td><?php echo htmlspecialchars(trim($production['RoleInProductionID'])); ?></td>
                    <td><a href="index.php?page=editproduction&ID=<?php echo htmlspecialchars(trim($production['ProductionID'])); ?>" class="btn">Edit</a></td>';
                    <td><a href="index.php?page=deleteproduction&ProductionID=<?php echo htmlspecialchars(trim($production['ProductionID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>';
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Production</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
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