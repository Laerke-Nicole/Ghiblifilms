<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $headline = htmlspecialchars(trim($_POST['Headline']));
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']));
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']));

    // image upload
    if (isset($_FILES['newsImg'])) {
        if (($_FILES['newsImg']['type'] == "image/jpeg" ||
            $_FILES['newsImg']['type'] == "image/pjpeg" ||
            $_FILES['newsImg']['type'] == "image/gif" ||
            $_FILES['newsImg']['type'] == "image/jpg") && 
            ($_FILES['newsImg']['size'] < 600000)) { 

            if ($_FILES['newsImg']['error'] > 0) {
                echo "Error: " . $_FILES['newsImg']['error'];
                exit(); // stop further execution

            } else {

                // check if file exists
                if (file_exists("../upload/" . $_FILES['newsImg']['name'])) {
                    echo "Can't upload: " . $_FILES['newsImg']['name'] . " exists.";
                    exit(); // stop further execution
                    
                } else {
                    // move uploaded file to the "upload" directory
                    move_uploaded_file($_FILES['newsImg']['tmp_name'], "../../upload/" . $_FILES['newsImg']['name']);
                    $newsImg = $_FILES['newsImg']['name']; // Get the filename

                    // insert data into the database
                    try {                  
                        $query = $dbCon->prepare("INSERT INTO News (Headline, SubHeadline, TextOfNews, NewsImg) VALUES (:headline, :subHeadline, :textOfNews, :newsImg)");
                        $query->bindParam(':headline', $headline);
                        $query->bindParam(':subHeadline', $subHeadline);
                        $query->bindParam(':textOfNews', $textOfNews);
                        $query->bindParam(':newsImg', $newsImg);
                        
                        // Execute and check for errors
                        if ($query->execute()) {
                            header("Location: ../../index.php?page=admin&status=added");
                        } else {
                            echo "Failed to insert data. Error: " . implode(", ", $query->errorInfo());
                        }
                    } catch (PDOException $e) {
                        echo "Database error: " . $e->getMessage();
                    }
                }
            }
        } else {
            echo "Invalid file type or size too large.";
            echo '<a href="../../index.php?page=admin">Go back</a>';
        }
    } else {
        echo "No file was uploaded.";
        echo '<a href="../../index.php?page=admin">Go back</a>';
    }

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>