<?php
confirm_is_admin();
?>

<!-- Movie voice actor -->
<div class="container">
    <h4>All Movies with their voice actors</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>Movie name</th>
                <th>Voice actor f + lname</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <!-- loop through the added items -->
            <tbody class="secondary-color">
            <?php foreach ($getMovieVoiceActorAdmin as $movieVoiceActor): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($movieVoiceActor['Name'])); ?></td>
                <td><?php echo htmlspecialchars(trim($movieVoiceActor['FirstName'])) . " " . htmlspecialchars(trim($movieVoiceActor['LastName'])); ?></td>
                
                <td><a href="index.php?page=editmovievoiceactor&MovieID=<?php echo htmlspecialchars(trim($movieVoiceActor['MovieID'])) . '&VoiceActorID=' . htmlspecialchars(trim($movieVoiceActor['VoiceActorID'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=controllerdelete&table=MovieVoiceActor&primaryKey=MovieID&primaryKeyValue=<?php echo htmlspecialchars(trim($movieVoiceActor['MovieID'])) . '&VoiceActorID=' . htmlspecialchars(trim($movieVoiceActor['VoiceActorID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Movie with the voice actors</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="MovieVoiceActor">
        <div class="row">
            <div class="input-field col s6">
                <p>Movie name</p>
                    <select name="MovieID" id="MovieID">
                        <?php
                            include ("controllers/adminController.php");
                            while ($movie = $movieQuery->fetch()) {
                                echo "<option value=\"" . htmlspecialchars(trim($movie['MovieID'])) . "\">" . htmlspecialchars(trim($movie['Name'])) . "</option>";
                            }
                        ?>
                    </select>
            </div>

            <div class="input-field col s6">
                <p>Voice actor name</p>
                    <select name="VoiceActorID" id="VoiceActorID">
                        <?php
                            include ("controllers/adminController.php");
                            while ($voiceActor = $voiceActorQuery->fetch()) {
                                echo "<option value=\"" . htmlspecialchars(trim($voiceActor['VoiceActorID'])) . "\">" . htmlspecialchars(trim($voiceActor['FirstName'])) . " " . htmlspecialchars(trim($voiceActor['FirstName'])) . "</option>";
                            }
                        ?>
                    </select>
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit" name="submit">Add</button>
    </form>
</div>