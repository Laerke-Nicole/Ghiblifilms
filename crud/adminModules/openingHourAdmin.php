<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// Get opening hours
$queryOpeningHour = $dbCon->prepare("SELECT * FROM OpeningHour");
$queryOpeningHour->execute();
$getOpeningHours = $queryOpeningHour->fetchAll();
?>

<!-- Opening Hours -->
<div class="container">
    <h2>All Opening Hours</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The opening hour has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The opening hour has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new opening hour has been successfully added!";
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
    <h3>Add New Opening Hour</h3>

    <form class="col s12" name="contact" method="post" action="crud/openingHour/addOpeningHour.php">
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