<?php
// Connect to db
$dbCon = dbCon($user, $pass);

// Get premiere
$queryPremiere = $dbCon->prepare("SELECT * FROM Premiere");
$queryPremiere->execute();
$getPremiere = $queryPremiere->fetchAll();
?>

<!-- Premiere -->
<div class="container">
    <h2>All Premiere</h2>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The premiere has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The premiere has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new premiere has been successfully added!";
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
                <th>PremiereID</th>
                <th>MovieID</th>
                <th>PremiereDate</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getPremiere)) {
                $getPremiere = [];
            }

            foreach ($getPremiere as $premiere) {
                echo "<tr>";
                echo "<td>" . $premiere['PremiereID'] . "</td>";
                echo "<td>" . $premiere['MovieID'] . "</td>";
                echo "<td>" . $premiere['PremiereDate'] . "</td>";
                echo '<td><a href="index.php?page=editpremiere&ID=' . $premiere['PremiereID'] . '" class="btn">Edit</a></td>';
                echo '<td><a href="index.php?page=deletepremiere&PremiereID=' . $premiere['PremiereID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h3>Add New Premiere</h3>

    <form class="col s12" name="contact" method="post" action="crud/premiere/addPremiere.php">
        <div class="row">
            <div class="input-field col s6">
                <input id="MovieID" name="MovieID" type="number" class="validate" required="" aria-required="true">
                <label for="MovieID">MovieID</label>
            </div>

            <div class="input-field col s6">
                <input id="PremiereDate" name="PremiereDate" type="date" class="validate" required="" aria-required="true">
                <label for="PremiereDate">PremiereDate</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>