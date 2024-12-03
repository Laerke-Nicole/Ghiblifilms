<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['NewsID']) && isset($_POST['submit'])) {
    // Get the input values, including the new image if uploaded
    $headline = htmlspecialchars(trim($_POST['Headline']));
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']));
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']));
    $newsID = htmlspecialchars(trim($_POST['NewsID']));

    // Initialize the $newsImg variable to store the file name
    $newsImg = null;

    // Check if a new image file is uploaded
    if (isset($_FILES['NewsImg']) && $_FILES['NewsImg']['error'] == UPLOAD_ERR_OK) {
        // Validate the uploaded file (type and size)
        $allowedTypes = ['image/jpeg', 'image/pjpeg', 'image/gif', 'image/jpg'];

        if (in_array($_FILES['NewsImg']['type'], $allowedTypes) && $_FILES['NewsImg']['size'] < 3000000) {
            // Move the uploaded file to the "upload" directory
            $newsImg = basename($_FILES['NewsImg']['name']);
            $uploadPath = "../../upload/" . $newsImg;

            if (move_uploaded_file($_FILES['NewsImg']['tmp_name'], $uploadPath)) {
                // Image upload succeeded, set $newsImg to the new file name
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
    $query = $dbCon->prepare("UPDATE News SET Headline = :headline, SubHeadline = :subHeadline, TextOfNews = :textOfNews, NewsImg = :newsImg WHERE NewsID = :newsID");
    
    $query->bindParam(':headline', $headline);
    $query->bindParam(':subHeadline', $subHeadline);
    $query->bindParam(':textOfNews', $textOfNews);
    $query->bindParam(':newsImg', $newsImg);
    $query->bindParam(':newsID', $newsID);

    if ($query->execute()) {
        header("Location: ../../index.php?page=admin&status=updated&ID=$newsID");
    } else {
        echo "Failed to update data. Error: " . implode(", ", $query->errorInfo());
    }

} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>