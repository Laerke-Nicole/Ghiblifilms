<?php
confirm_is_admin();
?>

<!-- Role In Production -->
<div class="container">
    <h4>All Role In Production</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>NameOfRole</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php foreach ($roleInProductionAdmin as $role): ?>
                <tr>
                    <td><?php echo htmlspecialchars(trim($role['NameOfRole'])); ?></td>
                    <td><a href="index.php?page=editroleinproduction&ID=<?php echo htmlspecialchars(trim($role['RoleInProductionID'])); ?>" class="btn">Edit</a></td>
                    <td><a href="index.php?page=controllerdelete&table=RoleInProduction&primaryKey=RoleInProductionID&primaryKeyValue=<?php echo htmlspecialchars(trim($role['RoleInProductionID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Role In Production</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
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