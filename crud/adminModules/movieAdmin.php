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

    <h2>All movies</h2>
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
                    <th>ScreenFormatID</th>
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
                    echo "<td><img src='" . $getMovie['MovieImg'] . "' alt='Movie Image' width='50'></td>";
                    echo "<td>". $getMovie['ScreenFormatID']."</td>";
                    echo "<td>";

                    echo "</td>";
                    echo '<td><a href="index.php?page=editmovie&ID='.$getMovie['MovieID'].'" class="btn">Edit</a></td>';
                    echo '<td><a href="crud/deleteMovie.php?MovieID='.$getMovie['MovieID'].'" class=" btn red" onclick="return confirm(\'Delete! are you sure?\')">Delete</a></td>';

                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>



        <hr>
        <h3>Add new movie</h3>

        <form class="col s12" method="post" action="crud/addMovie.php" enctype="multipart/form-data">
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
                <div class="file-field input-field col s6">
                    <div class="btn">
                        <span>Upload Image</span>
                        <input type="file" name="MovieImage" required>
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload movie image">
                    </div>
                </div>

                <div class="input-field col s6">
                    <input id="ScreenFormatID" name="ScreenFormatID" type="text" class="validate" required>
                    <label for="ScreenFormatID">Screen Format ID</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add Movie</button>
        </form>
    </div>
</div>