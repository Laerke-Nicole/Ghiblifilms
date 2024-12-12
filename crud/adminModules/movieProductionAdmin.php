<?php
confirm_logged_in();
?>

<!-- Movie production -->
<div class="container">
    <h4>All Movies with their production team</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>MovieID</th>
                <th>ProductionID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php foreach ($getMovieProduction as $movieProduction): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($movieProduction['MovieID'])); ?></td>
                <td><?php echo htmlspecialchars(trim($movieProduction['ProductionID'])); ?></td>

                <td><a href="index.php?page=editmovieproduction&MovieID=<?php echo htmlspecialchars(trim($movieProduction['MovieID'])) . '&ProductionID=' . htmlspecialchars(trim($movieProduction['ProductionID'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=deletemovieproduction&MovieID=<?php echo htmlspecialchars(trim($movieProduction['MovieID'])) . '&ProductionID=' . htmlspecialchars(trim($movieProduction['ProductionID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Movie with the production team</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="MovieProduction">
        <div class="row">
            <div class="input-field col s6">
                <input id="MovieID" name="MovieID" type="number" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>

            <div class="input-field col s6">
                <input id="ProductionID" name="ProductionID" type="number" class="validate" required="" aria-required="true">
                <label for="ProductionID">ProductionID</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>