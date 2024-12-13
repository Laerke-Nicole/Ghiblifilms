<?php
confirm_logged_in();
?>

<!-- Opening Hours -->
<div class="container">
    <h4>All Opening Hours</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>Day</th>
                <th>Time</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php foreach ($getOpeningHour as $openingHour): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($openingHour['Day'])); ?></td>
                <td><?php echo htmlspecialchars(trim($openingHour['Time'])); ?></td>
                <td><a href="index.php?page=editopeninghour&ID=<?php echo htmlspecialchars(trim($openingHour['OpeningHourID'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=deleteopeninghour&OpeningHourID=<?php echo htmlspecialchars(trim($openingHour['OpeningHourID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Opening Hour</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
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