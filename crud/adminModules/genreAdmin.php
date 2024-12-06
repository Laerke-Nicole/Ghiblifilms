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
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The genre has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The genre has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new genre has been successfully added!";
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
                echo "<td>" . $genre['GenreID'] . "</td>";
                echo "<td>" . $genre['GenreName'] . "</td>";
                echo '<td><a href="index.php?page=editgenre&ID=' . $genre['GenreID'] . '" class="btn">Edit</a></td>';
                echo '<td><a href="controllers/delete.php?table=Genre&primaryKey=GenreID&id=' . $genre['GenreID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                
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