<?php
confirm_logged_in();

// Get news
$queryNews = $dbCon->prepare("SELECT * FROM News");
$queryNews->execute();
$getNews = $queryNews->fetchAll();
?>



<!-- news -->
<div class="container">

    <h4>All news</h4>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "deleted") {
            echo "The news " . $_GET['ID'] . " has been successfully deleted!";
            echo "<script>M.toast({html: 'Deleted!'})</script>";
        } elseif ($_GET['status'] == "updated") {
            echo "The news " . $_GET['ID'] . " has been successfully Updated!";
            echo "<script>M.toast({html: 'Updated!'})</script>";
        } elseif ($_GET['status'] == "added") {
            echo "The new news has been successfully added!";
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
                <th>NewsID</th>
                <th>Headline</th>
                <th>SubHeadline</th>
                <th>Text</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>

            <tbody class="secondary-color">
            <?php
            foreach ($getNews as $news) {
                echo "<tr>";
                echo "<td>" . $news['NewsID'] . "</td>";
                echo "<td>" . $news['Headline'] . "</td>";
                echo "<td>" . $news['SubHeadline'] . "</td>";
                echo "<td>" . $news['TextOfNews'] . "</td>";
                echo "<td><img src='upload/" . $news['NewsImg'] . "' alt='Image of news' width='100'></td>";

                echo '<td><a href="index.php?page=editnews&ID=' . $news['NewsID'] . '" class="waves-effect waves-light btn">Edit</a></td>';
                echo '<td><a href="index.php?page=deletenews&NewsID=' . $news['NewsID'] . '" class="waves-effect waves-light btn red" onclick="return confirm(\'Delete! Are you sure?\')">Delete</a></td>';
               
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <hr>
        <h4>Add New News</h4>
        <form class="col s12" name="contact" method="post" action="crud/news/addNews.php" enctype="multipart/form-data">
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

            <button class="btn waves-effect waves-light" type="submit" name="submit">Add News</button>
        </form>

    </div>
</div>