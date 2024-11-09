<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// Get Movie Production
$queryMovieProduction = $dbCon->prepare("SELECT * FROM MovieProduction");
$queryMovieProduction->execute();
$getMovieProduction = $queryMovieProduction->fetchAll();
?>

<!-- Movie production -->
<div class="container">
    <h2>All Movies with their production team</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The movie production has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The movie production has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new movie production has been successfully added!";
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
                <th>ProductionID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getMovieProduction)) {
                $getMovieProduction = [];
            }

            foreach ($getMovieProduction as $movieProduction) {
                echo "<tr>";
                echo "<td>" . $movieProduction['MovieID'] . "</td>";
                echo "<td>" . $movieProduction['ProductionID'] . "</td>";

                echo '<td><a href="index.php?page=editmovieproduction&MovieID=' . $movieProduction['MovieID'] . '&ProductionID=' . $movieProduction['ProductionID'] . '" class="btn">Edit</a></td>';
                echo '<td><a href="index.php?page=deletemovieproduction&MovieID=' . $movieProduction['MovieID'] . '&ProductionID=' . $movieProduction['ProductionID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';

                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h3>Add New Movie with the production team</h3>

    <form class="col s12" name="contact" method="post" action="crud/movieProduction/addMovieProduction.php">
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