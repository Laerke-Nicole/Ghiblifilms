<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// Get news
$queryMovie = $dbCon->prepare("SELECT * FROM Movie");
$queryMovie->execute();
$getMovies = $queryMovie->fetchAll();
?>


<!-- movie -->
<div class="container">

    <h4>All movies</h4>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The movie " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The movie " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new movie has been successfully added!";
            echo "<script>M.toast({html: 'Added!'})</script>";
        } elseif ($_GET['status'] == 0) {
            echo "Forbidden access - redirected to home!";
            echo "<script>M.toast({html: 'Access denied!'})</script>";
        }
    }
    ?>
    <div class="row">
        <div class="row">
            <table class="highlight">
                <thead>
                <tr class="secondary-color">
                    <th>MovieID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Release year</th>
                    <th>Duration</th>
                    <th>Movie Image</th>
                    <th>Genres</th>
                    <th>Production</th>
                    <th>Voice Actors</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>

                <tbody class="secondary-color">
                <?php
                foreach ($getMovies as $getMovie) {
                    echo "<tr>";
                    echo "<td>". $getMovie['MovieID']."</td>";
                    echo "<td>". $getMovie['Name']."</td>";
                    echo "<td>". $getMovie['Description']."</td>";
                    echo "<td>". $getMovie['ReleaseYear']."</td>";
                    echo "<td>". $getMovie['Duration']."</td>";
                    echo "<td><img src='upload/" . $getMovie['MovieImg'] . "' alt='Image of movie' width='100'></td>";

                    // get and display genres
                    $genreQuery = $dbCon->prepare("SELECT GenreName FROM Genre INNER JOIN MovieGenre ON Genre.GenreID = MovieGenre.GenreID WHERE MovieGenre.MovieID = ?");
                    $genreQuery->execute([$getMovie['MovieID']]);
                    $genres = $genreQuery->fetchAll(PDO::FETCH_COLUMN);
                    echo "<td>" . implode(", ", $genres) . "</td>";

                    // get and display production team
                    $productionQuery = $dbCon->prepare("SELECT CONCAT(FirstName, ' ', LastName) AS FullName FROM Production INNER JOIN MovieProduction ON Production.ProductionID = MovieProduction.ProductionID WHERE MovieProduction.MovieID = ?");
                    $productionQuery->execute([$getMovie['MovieID']]);
                    $productions = $productionQuery->fetchAll(PDO::FETCH_COLUMN);
                    echo "<td>" . implode(", ", $productions) . "</td>";

                    // get and display voice actors
                    $voiceActorQuery = $dbCon->prepare("SELECT CONCAT(FirstName, ' ', LastName) AS FullName FROM VoiceActor INNER JOIN MovieVoiceActor ON VoiceActor.VoiceActorID = MovieVoiceActor.VoiceActorID WHERE MovieVoiceActor.MovieID = ?");
                    $voiceActorQuery->execute([$getMovie['MovieID']]);
                    $voiceActors = $voiceActorQuery->fetchAll(PDO::FETCH_COLUMN);
                    echo "<td>" . implode(", ", $voiceActors) . "</td>";

                    echo "<td>";

                    echo "</td>";
                    echo '<td><a href="index.php?page=editmovie&ID='.$getMovie['MovieID'].'" class="btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deletemovie&MovieID=' . $getMovie['MovieID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';

                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>



        <hr>
        <h4>Add new movie</h4>

        <form class="col s12" method="post" action="crud/movie/addMovie.php" enctype="multipart/form-data">
            <div class="row">
                <div class="input-field col s12">
                    <input id="Name" name="Name" type="text" class="validate" required>
                    <label for="Name">Movie Name</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <textarea id="Description" name="Description" class="materialize-textarea" required></textarea>
                    <label for="Description">Description</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s6">
                    <input id="ReleaseYear" name="ReleaseYear" type="number" class="validate" required>
                    <label for="ReleaseYear">Release Year</label>
                </div>

                <div class="input-field col s6">
                    <input id="Duration" name="Duration" type="text" class="validate" required>
                    <label for="Duration">Duration</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="movieImg" name="movieImg" type="file" class="validate" required="" aria-required="true">
                </div>
            </div>
            
            <button class="btn waves-effect waves-light" type="submit" name="submit">Add Movie</button>
        </form>
    </div>
</div>