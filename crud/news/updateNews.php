<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['NewsID']) && isset($_POST['submit'])) {
    // Get the input values, including the new image if uploaded
    $headline = htmlspecialchars(trim($_POST['Headline']), ENT_QUOTES, 'UTF-8');
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']), ENT_QUOTES, 'UTF-8');
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']), ENT_QUOTES, 'UTF-8');
    $newsID = htmlspecialchars(trim($_POST['NewsID']), ENT_QUOTES, 'UTF-8');

    $dbCon = dbCon($user, $pass);

    // Initialize the $newsImage variable to store the file name
    $newsImage = null;

    // Check if a new image file is uploaded
    if (isset($_FILES['NewsImage']) && $_FILES['NewsImage']['error'] == UPLOAD_ERR_OK) {
        // Validate the uploaded file (type and size)
        $allowedTypes = ['image/jpeg', 'image/pjpeg', 'image/gif', 'image/jpg'];

        if (in_array($_FILES['NewsImage']['type'], $allowedTypes) && $_FILES['NewsImage']['size'] < 3000000) {
            // Move the uploaded file to the "upload" directory
            $newsImage = basename($_FILES['NewsImage']['name']);
            $uploadPath = "../../upload/" . $newsImage;

            if (move_uploaded_file($_FILES['NewsImage']['tmp_name'], $uploadPath)) {
                // Image upload succeeded, set $newsImage to the new file name
            } else {
                echo "Failed to move uploaded file.";
                exit();
            }

        } else {
            echo "Invalid file type or file size too large.";
            exit();
        }
    }
    // Prepare statement
    $query = $dbCon->prepare("UPDATE News SET Headline = :headline, SubHeadline = :subHeadline, TextOfNews = :textOfNews, NewsImage = :newsImage WHERE NewsID = :newsID");
    
    $query->bindParam(':headline', $headline);
    $query->bindParam(':subHeadline', $subHeadline);
    $query->bindParam(':textOfNews', $textOfNews);
    $query->bindParam(':newsImage', $newsImage);
    $query->bindParam(':newsID', $newsID, PDO::PARAM_INT);

    if ($query->execute()) {
        header("Location: ../../index.php?page=admin&status=updated&ID=$newsID");
    } else {
        echo "Failed to update data. Error: " . implode(", ", $query->errorInfo());
    }

} else {
    header("Location: ../index.php?page=admin&status=0");
}
?>