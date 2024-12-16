<?php
confirm_is_admin();
?>

<!--  voice actor -->
<div class="container">
    <h4>All s with their voice actors</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>FirstName</th>
                <th>LastName</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <!-- loop through the added items -->
            <tbody class="secondary-color">
            <?php foreach ($getVoiceActorAdmin as $VoiceActor): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($VoiceActor['FirstName'])); ?></td>
                <td><?php echo htmlspecialchars(trim($VoiceActor['LastName'])); ?></td>
                <td><a href="index.php?page=editvoiceactor&ID=<?php echo htmlspecialchars(trim($VoiceActor['VoiceActorID'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=controllerdelete&table=VoiceActor&primaryKey=VoiceActorID&primaryKeyValue=<?php echo htmlspecialchars(trim($VoiceActor['VoiceActorID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>
               
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New voice actor</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
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