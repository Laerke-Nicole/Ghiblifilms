<?php
confirm_logged_in();

// Get opening hours
$queryOpeningHour = $dbCon->prepare("SELECT * FROM OpeningHour");
$queryOpeningHour->execute();
$getOpeningHours = $queryOpeningHour->fetchAll();
?>

<!-- Opening Hours -->
<div class="container">
    <h4>All Opening Hours</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>OpeningHourID</th>
                <th>Day</th>
                <th>Time</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getOpeningHours)) {
                $getOpeningHours = [];
            }

            foreach ($getOpeningHours as $getOpeningHour) {
                echo "<tr>";
                echo "<td>" . $getOpeningHour['OpeningHourID'] . "</td>";
                echo "<td>" . $getOpeningHour['Day'] . "</td>";
                echo "<td>" . $getOpeningHour['Time'] . "</td>";
                echo '<td><a href="index.php?page=editopeninghour&ID=' . $getOpeningHour['OpeningHourID'] . '" class="btn">Edit</a></td>';
                echo '<td><a href="index.php?page=deleteopeninghour&OpeningHourID=' . $getOpeningHour['OpeningHourID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Opening Hour</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="OpeningHour">
        <div class="row">
            <div class="input-field col s6">
                <input id="Day" name="Day" type="text" class="validate" required="" aria-required="true">
                <label for="Day">Day</label>
            </div>

            <div class="input-field col s6">
                <input id="Time" name="Time" type="text" class="validate" required="" aria-required="true">
                <label for="Time">Time</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>