<?php
confirm_is_admin();
?>



<!-- news -->
<div class="container">

    <h4>All news</h4>
    <div class="row">
        <table class="highlight">
            <thead>
            <tr class="secondary-color">
                <th>Headline</th>
                <th>SubHeadline</th>
                <th>Text</th>
                <th>Image</th>
                <th>Date</th>
                <th>Type</th>
                <th>Author</th>

                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <!-- loop through the added items -->
            <tbody class="secondary-color">
            <?php foreach ($getNewsAdmin as $news): ?>
                <tr>
                <td><?php echo htmlspecialchars(trim($news['Headline'])); ?></td>
                <td><?php echo htmlspecialchars(trim($news['SubHeadline'])); ?></td>
                <td><?php echo htmlspecialchars(trim($news['TextOfNews'])); ?></td>
                <td><img src='upload/<?php echo htmlspecialchars(trim($news['NewsImg'])); ?>' alt='Image of news' width='100'></td>
                <td><?php echo htmlspecialchars(trim($news['DateOfNews'])); ?></td>
                <td><?php echo htmlspecialchars(trim($news['TypeOfNews'])); ?></td>
                <td><?php echo htmlspecialchars(trim($news['Author'])); ?></td>

                <td><a href="index.php?page=editnews&ID=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="btn">Edit</a></td>
                <td><a href="index.php?page=controllerdelete&table=News&primaryKey=NewsID&primaryKeyValue=<?php echo htmlspecialchars(trim($news['NewsID'])); ?>" class="waves-effect waves-light btn red" onclick="return confirm('Delete! Are you sure?')">Delete</a></td>
               
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <hr>
        <h4>Add New News</h4>
        <form class="col s12" name="contact" method="post" action="crud/news/addNews.php" enctype="multipart/form-data">
            <!-- csrf protection -->
            <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">

            <div class="row">
                <div class="input-field col s12">
                    <input id="Headline" name="Headline" type="text" class="validate" required="" aria-required="true">
                    <label for="Headline">Headline</label>
                </div>
            </div>
            
            <div class="row">
                <div class="input-field col s12">
                    <input id="SubHeadline" name="SubHeadline" type="text" class="validate" required="" aria-required="true">
                    <label for="SubHeadline">Subheadline</label>
                </div>
            </div>  

            <div class="row">
                <div class="input-field col s12">
                    <textarea id="TextOfNews" name="TextOfNews" class="materialize-textarea" required="" aria-required="true"></textarea>
                    <label for="TextOfNews">Text of news</label>
                </div>
            </div>   
            
            <div class="row">
                <div class="input-field col s12">
                    <input id="newsImg" name="newsImg" type="file" class="validate" required="" aria-required="true">
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="DateOfNews" name="DateOfNews" type="date" class="validate" required="" aria-required="true">
                    <label for="DateOfNews">Date of news</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="TypeOfNews" name="TypeOfNews" type="text" class="validate" required="" aria-required="true">
                    <label for="TypeOfNews">Type of news</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input id="Author" name="Author" type="text" class="validate" required="" aria-required="true">
                    <label for="Author">Author</label>
                </div>
            </div>

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add News</button>
        </form>

    </div>
</div>