<?php
require_once "dbcon.php";

if (isset($_POST['submit'])) {
    // trim and htmlspecialchars
    $headline = htmlspecialchars(trim($_POST['Headline']), ENT_QUOTES, 'UTF-8');
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']), ENT_QUOTES, 'UTF-8');
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']), ENT_QUOTES, 'UTF-8');

    // image upload
    if (isset($_FILES['newsImage'])) {
        if (($_FILES['newsImage']['type'] == "image/jpeg" ||
            $_FILES['newsImage']['type'] == "image/pjpeg" ||
            $_FILES['newsImage']['type'] == "image/gif" ||
            $_FILES['newsImage']['type'] == "image/jpg") && 
            ($_FILES['newsImage']['size'] < 3000000)) { 

            if ($_FILES['newsImage']['error'] > 0) {
                echo "Error: " . $_FILES['newsImage']['error'];
                exit(); // Stop further execution
            } else {
                // Check if file exists
                if (file_exists("../upload/" . $_FILES['newsImage']['name'])) {
                    echo "Can't upload: " . $_FILES['newsImage']['name'] . " exists.";
                    exit(); // Stop further execution
                } else {
                    // Move uploaded file to the "upload" directory
                    move_uploaded_file($_FILES['newsImage']['tmp_name'], "../upload/" . $_FILES['newsImage']['name']);
                    $newsImage = $_FILES['newsImage']['name']; // Get the filename

                    // Insert data into the database
                    try {
                        $dbCon = dbCon($user, $pass);
                        $query = $dbCon->prepare("INSERT INTO News (Headline, SubHeadline, TextOfNews, NewsImage) VALUES (:headline, :subHeadline, :textOfNews, :newsImage)");
                        $query->bindParam(':headline', $headline);
                        $query->bindParam(':subHeadline', $subHeadline);
                        $query->bindParam(':textOfNews', $textOfNews);
                        $query->bindParam(':newsImage', $newsImage);
                        
                        // Execute and check for errors
                        if ($query->execute()) {
                            header("Location: ../index.php?page=admin&status=added");
                            exit(); // Always call exit after header redirection
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
        }
    } else {
        echo "No file was uploaded.";
    }

} else {
    header("Location: ../index.php?page=admin&status=0");
    exit(); // Always call exit after header redirection
}
?>





<!-- header("Location: ../index.php?page=admin&status=added");

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?> -->