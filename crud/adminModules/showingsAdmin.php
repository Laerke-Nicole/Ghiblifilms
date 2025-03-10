<?php
confirm_is_admin();
?>

<!-- showings -->
<div class="container">
    <h4>All showings</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>Movie name</th>
                <th>Auditorium</th>
                <th>ScreenFormat</th>
                <th>ShowingDate</th>
                <th>ShowingTime</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <!-- loop through the added items -->
            <tbody class="secondary-color">
            <?php foreach ($showings as $showings): ?>
                <tr>
                    <td><?php echo htmlspecialchars(trim($showings['Name'])); ?></td>
                    <td><?php echo htmlspecialchars(trim($showings['AuditoriumNumber'])); ?></td>
                    <td><?php echo htmlspecialchars(trim($showings['ScreenFormat'])); ?></td>
                    <td><?php echo htmlspecialchars(trim($showings['ShowingDate'])); ?></td>
                    <td><?php echo htmlspecialchars(trim($showings['ShowingTime'])); ?></td>
                    <td><a href="index.php?page=editshowings&ID=<?php echo htmlspecialchars(trim($showings['ShowingsID'])); ?>" class="btn">Edit</a></td>
                    <td><a href="index.php?page=controllerdelete&table=Showings&primaryKey=ShowingsID&primaryKeyValue=<?php echo htmlspecialchars(trim($showings['ShowingsID'])); ?>" class="btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
    <h4>Add New Showing</h4>

    <form class="col s12" name="contact" method="post" action="controllers/create.php">
        <!-- csrf protection -->
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
        
        <!-- to tell create.php which table to insert data into -->
        <input type="hidden" name="table" value="Showings">
        <div class="row">
            <div class="input-field col s12">
                <p>Movie name</p>
                <select name="MovieID" id="MovieID">
                    <?php
                        include ("controllers/movieController.php");
                        while ($movie = $movieQuery->fetch()) {
                            echo "<option value=\"" . htmlspecialchars(trim($movie['MovieID'])) . "\">" . htmlspecialchars(trim($movie['Name'])) . "</option>";
                        }
                    ?>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s6">
                <p>Auditorium</p>
                <select name="AuditoriumID" id="AuditoriumID">
                    <?php
                        include ("controllers/movieController.php");
                        while ($auditorium = $auditoriumQuery->fetch()) {
                            echo "<option value=\"" . htmlspecialchars(trim($auditorium['AuditoriumID'])) . "\">" . htmlspecialchars(trim($auditorium['AuditoriumNumber'])) . "</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="input-field col s6">
                <p>ScreenFormat</p>
                <select name="ScreenFormatID" id="ScreenFormatID">
                    <?php
                        include ("controllers/movieController.php");
                        while ($screenFormat = $screenFormatQuery->fetch()) {
                            echo "<option value=\"" . htmlspecialchars(trim($screenFormat['ScreenFormatID'])) . "\">" . htmlspecialchars(trim($screenFormat['ScreenFormat'])) . "</option>";
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