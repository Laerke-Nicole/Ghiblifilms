<?php
confirm_logged_in();

// Get opening hours
$queryGenre = $dbCon->prepare("SELECT * FROM Genre");
$queryGenre->execute();
$getGenre = $queryGenre->fetchAll();
?>

<!-- Opening Hours -->
<div class="container">
    <h4>All Genres</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>GenreID</th>
                <th>GenreName</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getGenre)) {
                $getGenre = [];
            }

            foreach ($getGenre as $genre) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars(trim($genre['GenreID'])) . "</td>";
                echo "<td>" . htmlspecialchars(trim($genre['GenreName'])) . "</td>";
                echo '<td><a href="index.php?page=editgenre&ID=' . htmlspecialchars(trim($genre['GenreID'])) . '" class="btn">Edit</a></td>';
                echo '<td><a href="controllers/delete.php?table=Genre&primaryKey=GenreID&id=' . htmlspecialchars(trim($genre['GenreID'])) . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                
                // echo '<td><a href="index.php?page=deletegenre&GenreID=' . $genre['GenreID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Genre</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
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