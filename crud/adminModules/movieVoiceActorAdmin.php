<?php
// Get Movie Production
$queryMovieVoiceActor = $dbCon->prepare("SELECT * FROM MovieVoiceActor");
$queryMovieVoiceActor->execute();
$getMovieVoiceActor = $queryMovieVoiceActor->fetchAll();
?>

<!-- Movie voice actor -->
<div class="container">
    <h4>All Movies with their voice actors</h4>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The movie voice actor has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The movie voice actor has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new movie voice actor has been successfully added!";
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
                <th>VoiceActorID</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getMovieVoiceActor)) {
                $getMovieVoiceActor = [];
            }

            foreach ($getMovieVoiceActor as $movieVoiceActor) {
                echo "<tr>";
                echo "<td>" . $movieVoiceActor['MovieID'] . "</td>";
                echo "<td>" . $movieVoiceActor['VoiceActorID'] . "</td>";

                echo '<td><a href="index.php?page=editmovievoiceactor&MovieID=' . $movieProduction['MovieID'] . '&VoiceActorID=' . $movieVoiceActor['VoiceActorID'] . '" class="btn">Edit</a></td>';
                echo '<td><a href="index.php?page=deletemovievoiceactor&MovieID=' . $movieProduction['MovieID'] . '&VoiceActorID=' . $movieVoiceActor['VoiceActorID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';

                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Movie with the voice actors</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="MovieVoiceActor">
        <div class="row">
            <div class="input-field col s6">
                <input id="MovieID" name="MovieID" type="number" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>

            <div class="input-field col s6">
                <input id="VoiceActorID" name="VoiceActorID" type="number" class="validate" required="" aria-required="true">
                <label for="VoiceActorID">VoiceActorID</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>