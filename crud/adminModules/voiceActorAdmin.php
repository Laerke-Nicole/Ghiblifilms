<?php
// Get voice actor
$queryVoiceActor = $dbCon->prepare("SELECT * FROM VoiceActor");
$queryVoiceActor->execute();
$getVoiceActor = $queryVoiceActor->fetchAll();
?>

<!--  voice actor -->
<div class="container">
    <h4>All s with their voice actors</h4>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The voice actor has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The voice actor has been successfully updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new voice actor has been successfully added!";
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
                <th>VoiceActorID</th>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            if (!isset($getVoiceActor)) {
                $getVoiceActor = [];
            }

            foreach ($getVoiceActor as $VoiceActor) {
                echo "<tr>";
                echo "<td>" . $VoiceActor['VoiceActorID'] . "</td>";
                echo "<td>" . $VoiceActor['FirstName'] . "</td>";
                echo "<td>" . $VoiceActor['LastName'] . "</td>";
                echo '<td><a href="index.php?page=editvoiceactor&ID=' . $VoiceActor['VoiceActorID'] . '" class="btn">Edit</a></td>';
                echo '<td><a href="index.php?page=deletevoiceactor&VoiceActorID=' . $VoiceActor['VoiceActorID'] . '" class="btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
               

                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New voice actor</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="VoiceActor">
        <div class="row">
            <div class="input-field col s6">
                <input id="FirstName" name="FirstName" type="text" class="validate" required="" aria-required="true">
                <label for="FirstName">FirstName</label>
            </div>

            <div class="input-field col s6">
                <input id="LastName" name="LastName" type="text" class="validate" required="" aria-required="true">
                <label for="LastName">LastName</label>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>