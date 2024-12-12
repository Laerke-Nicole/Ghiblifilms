<?php
confirm_logged_in();
?>

<!-- Movie voice actor -->
<div class="container">
    <h4>All Movies with their voice actors</h4>
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
            <?php foreach ($getMovieVoiceActor as $movieVoiceActor): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($movieVoiceActor['MovieID'])); ?></td>
                <td><?php echo htmlspecialchars(trim($movieVoiceActor['VoiceActorID'])); ?></td>
                
                <td><a href="index.php?page=editmovievoiceactor&MovieID=<?php echo htmlspecialchars(trim($movieVoiceActor['MovieID'])) . '&VoiceActorID=' . htmlspecialchars(trim($movieVoiceActor['VoiceActorID'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=deletemovievoiceactor&MovieID=<?php echo htmlspecialchars(trim($movieVoiceActor['MovieID'])) . '&VoiceActorID=' . htmlspecialchars(trim($movieVoiceActor['VoiceActorID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>

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