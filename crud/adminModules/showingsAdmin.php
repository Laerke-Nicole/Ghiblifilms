<?php
confirm_logged_in();

// Get showings
$queryShowings = $dbCon->prepare("SELECT * FROM Showings");
$queryShowings->execute();
$getShowings = $queryShowings->fetchAll();
?>

<!-- showings -->
<div class="container">
    <h4>All showings</h4>
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
                    echo "<td>" . htmlspecialchars(trim($showings['ShowingsID'])) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($showings['MovieID'])) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($showings['AuditoriumID'])) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($showings['ScreenFormatID'])) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($showings['ShowingDate'])) . "</td>";
                    echo "<td>" . htmlspecialchars(trim($showings['ShowingTime'])) . "</td>";
                    echo '<td><a href="index.php?page=editshowings&ID=' . htmlspecialchars(trim($showings['ShowingsID'])) . '" class="btn">Edit</a></td>';
                    echo '<td><a href="index.php?page=deleteshowings&ShowingsID=' . htmlspecialchars(trim($showings['ShowingsID'])) . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Showing</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="Showings">
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