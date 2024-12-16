<?php
confirm_is_admin();
?>

<!-- genres -->
<div class="container">
    <h4>All Genres</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>GenreName</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">

            <?php foreach ($getGenre as $genre): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($genre['GenreName'])); ?></td>
                <td><a href="index.php?page=editgenre&ID=<?php echo htmlspecialchars(trim($genre['GenreID'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=controllerdelete&table=Genre&primaryKey=GenreID&primaryKeyValue=<?php echo htmlspecialchars(trim($genre['GenreID'])); ?>" class="waves-effect waves-light btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Genre</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="Genre">
        <div class="row">
            <div class="input-field col s6">
                <input id="GenreName" name="GenreName" type="text" class="validate" required="" aria-required="true">
                <label for="GenreName">Genre name</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>