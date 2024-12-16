<?php
confirm_is_admin();
?>

<!-- Movie genre -->
<div class="container">
    <h4>All Movies with their Genre</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>Movie name</th>
                <th>Genre name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <!-- loop through the added items -->
            <tbody class="secondary-color">
            <?php foreach ($getMovieGenre as $movieGenre): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($movieGenre['Name'])); ?></td>
                <td><?php echo htmlspecialchars(trim($movieGenre['GenreName'])); ?></td>

                <td><a href="index.php?page=editmoviegenre&MovieID=<?php echo htmlspecialchars(trim($movieGenre['MovieID'])) . '&GenreID=' . htmlspecialchars(trim($movieGenre['GenreID'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=controllerdelete&table=MovieGenre&primaryKey=MovieID&primaryKeyValue=<?php echo htmlspecialchars(trim($movieGenre['MovieID'])) . '&GenreID=' . htmlspecialchars(trim($movieGenre['GenreID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Movie with their Genre</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="MovieGenre">
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
                <p>Genre name</p>
                <select name="GenreID" id="GenreID">
                    <?php
                        include ("controllers/adminController.php");
                        while ($genre = $genreQuery->fetch()) {
                            echo "<option value=\"" . htmlspecialchars(trim($genre['GenreID'])) . "\">" . htmlspecialchars(trim($genre['GenreName'])) . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>