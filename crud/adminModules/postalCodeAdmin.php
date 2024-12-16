<?php
confirm_is_admin();
?>

<!-- Postal Code -->
<div class="container">
    <h4>All Postal codes + their city</h4>
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

            <!-- loop through the added items -->
            <tbody class="secondary-color">
            <?php foreach ($getPostalCodeAdmin as $postalCode): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($postalCode['PostalCode'])); ?></td>
                <td><?php echo htmlspecialchars(trim($postalCode['City'])); ?></td>
                <td><a href="index.php?page=editpostalcode&ID=<?php echo htmlspecialchars(trim($postalCode['PostalCode'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=controllerdelete&table=PostalCode&primaryKey=PostalCode&primaryKeyValue=<?php echo htmlspecialchars(trim($postalCode['PostalCode'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Postal Code</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="PostalCode">
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