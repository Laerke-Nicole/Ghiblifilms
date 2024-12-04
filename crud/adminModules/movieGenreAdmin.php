<?php
// Get Movie Genre
$queryMovieGenre = $dbCon->prepare("SELECT * FROM MovieGenre");
$queryMovieGenre->execute();
$getMovieGenre = $queryMovieGenre->fetchAll();
?>

<!-- Movie genre -->
<div class="container">
    <h4>All Movies with their Genre</h4>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The movie genre has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The movie genre has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new movie genre has been successfully added!";
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
                <th>MovieID</th>
                <th>GenreID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getMovieGenre)) {
                $getMovieGenre = [];
            }

            foreach ($getMovieGenre as $movieGenre) {
                echo "<tr>";
                echo "<td>" . $movieGenre['MovieID'] . "</td>";
                echo "<td>" . $movieGenre['GenreID'] . "</td>";

                echo '<td><a href="index.php?page=editmoviegenre&MovieID=' . $movieGenre['MovieID'] . '&GenreID=' . $movieGenre['GenreID'] . '" class="btn">Edit</a></td>';
                echo '<td><a href="index.php?page=deletemoviegenre&MovieID=' . $movieGenre['MovieID'] . '&GenreID=' . $movieGenre['GenreID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';


                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Movie with their Genre</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="MovieGenre">
        <div class="row">
            <div class="input-field col s6">
                <input id="MovieID" name="MovieID" type="number" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>

            <div class="input-field col s6">
                <input id="GenreID" name="GenreID" type="number" class="validate" required="" aria-required="true">
                <label for="GenreID">GenreID</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>