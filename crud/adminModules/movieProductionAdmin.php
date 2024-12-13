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
                <th>Movie name</th>
                <th>Production F + Lname</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php foreach ($getMovieProductionAdmin as $movieProduction): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($movieProduction['Name'])); ?></td>
                <td><?php echo htmlspecialchars(trim($movieProduction['FirstName'])) . " " . htmlspecialchars(trim($movieProduction['LastName'])); ?></td>
                
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
                <p>Movie name</p>
                <select name="MovieID" id="MovieID">
                    <?php
                        include ("controllers/adminController.php");
                        while ($movie = $movieQuery->fetch()) {
                            echo "<option value=\"" . htmlspecialchars(trim($movie['MovieID'])) . "\">" . htmlspecialchars(trim($movie['Name'])) . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="input-field col s6">
                <p>Production name</p>
                <select name="ProductionID" id="ProductionID">
                    <?php
                        include ("controllers/adminController.php");
                        while ($production = $productionQuery->fetch()) {
                            echo "<option value=\"" . htmlspecialchars(trim($production['ProductionID'])) . "\">" . htmlspecialchars(trim($production['FirstName'])) . " " . htmlspecialchars(trim($production['LastName'])) . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>