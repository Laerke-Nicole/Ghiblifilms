<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// Get opening hours
$queryShowings = $dbCon->prepare("SELECT * FROM Showings");
$queryShowings->execute();
$getShowings = $queryShowings->fetchAll();
?>

<!-- showings -->
<div class="container">
    <h2>All showings</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The showing has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The showing has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new showing has been successfully added!";
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
                <th>ShowingsID</th>
                <th>MovieID</th>
                <th>AuditoriumID</th>
                <th>ScreenFormatID</th>
                <th>ShowingDate</th>
                <th>ShowingTime</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getShowings)) {
                $getShowings = [];
            }

            foreach ($getShowings as $showings) {
                echo "<tr>";
                    echo "<td>" . $showings['ShowingsID'] . "</td>";
                    echo "<td>" . $showings['MovieID'] . "</td>";
                    echo "<td>" . $showings['AuditoriumID'] . "</td>";
                    echo "<td>" . $showings['ScreenFormatID'] . "</td>";
                    echo "<td>" . $showings['ShowingDate'] . "</td>";
                    echo "<td>" . $showings['ShowingTime'] . "</td>";
                    echo '<td><a href="index.php?page=editshowings&ID=' . $showings['ShowingsID'] . '" class="btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deleteshowings&ShowingsID=' . $showings['ShowingsID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h3>Add New Showing</h3>

    <form class="col s12" name="contact" method="post" action="crud/showings/addShowings.php">
        <div class="row">
            <div class="input-field col s12">
                <input id="MovieID" name="MovieID" type="text" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <p>Auditorium</p>
                <select name="AuditoriumID" id="AuditoriumID">
                    <?php
                        $auditoriumQuery = $dbCon->query("SELECT AuditoriumID, AuditoriumNumber FROM Auditorium");
                        while ($auditorium = $auditoriumQuery->fetch()) {
                            echo "<option value='{$auditorium['AuditoriumID']}'>{$auditorium['AuditoriumNumber']}</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="input-field col s6">
                <p>ScreenFormat</p>
                <select name="ScreenFormatID" id="ScreenFormatID">
                    <?php
                        $screenFormatQuery = $dbCon->query("SELECT ScreenFormatID, ScreenFormat FROM ScreenFormat");
                        while ($screenFormat = $screenFormatQuery->fetch()) {
                            echo "<option value='{$screenFormat['ScreenFormatID']}'>{$screenFormat['ScreenFormat']}</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <input id="ShowingDate" name="ShowingDate" type="date" class="validate" required="" aria-required="true">
                <label for="ShowingDate">ShowingDate</label>
            </div>
            <div class="input-field col s6">
                <input id="ShowingTime" name="ShowingTime" type="time" class="validate" required="" aria-required="true">
                <label for="ShowingTime">ShowingTime</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>