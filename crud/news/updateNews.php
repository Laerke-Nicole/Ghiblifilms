<?php
require_once "../../includes/dbcon.php";
require_once "../../oop/resizerOOP.php";

// if the form is submitted
if (isset($_POST['NewsID']) && isset($_POST['submit'])) {
    // get the input values
    $headline = htmlspecialchars(trim($_POST['Headline']));
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']));
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']));
    $dateOfNews = htmlspecialchars(trim($_POST['DateOfNews']));
    $typeOfNews = htmlspecialchars(trim($_POST['TypeOfNews']));
    $author = htmlspecialchars(trim($_POST['Author']));
    $newsID = htmlspecialchars(trim($_POST['NewsID']));

    // initialize the $newsImg variable to store the file name
    $newsImg = null;

    // check if a new image file is uploaded
    if (isset($_FILES['NewsImg']) && $_FILES['NewsImg']['error'] == UPLOAD_ERR_OK) {
        // validate the uploaded file is the right type
        $allowedTypes = ['image/jpeg', 'image/pjpeg', 'image/gif', 'image/jpg', 'image/png'];

        if (in_array($_FILES['NewsImg']['type'], $allowedTypes) && $_FILES['NewsImg']['size'] < 4000000) {
            // move the uploaded file to the "upload" folder
            $newsImg = basename($_FILES['NewsImg']['name']);
            $uploadPath = "../../upload/" . $newsImg;

            if (move_uploaded_file($_FILES['NewsImg']['tmp_name'], $uploadPath)) {
                // resize the uploaded image
                try {
                    $resizer = new Resizer();
                    $resizer->load($uploadPath);
                    // size of the image
                    $resizer->resize(1000, 550);
                    $resizer->save($uploadPath);
                // catch any exceptions
                } catch (Exception $e) {
                    echo "Error resizing image: " . $e->getMessage();
                    exit();
                }
            } else {
                echo "Failed to move uploaded file.";
                exit();
            }

        } else {
            echo "Invalid file type or file size too large.";
            exit();
        }
    }
    // update news data
    $query = $dbCon->prepare("UPDATE News SET Headline = :headline, SubHeadline = :subHeadline, TextOfNews = :textOfNews, DateOfNews = :dateOfNews, TypeOfNews = :typeOfNews, Author = :author, NewsImg = :newsImg WHERE NewsID = :newsID");
    
    $query->bindParam(':headline', $headline);
    $query->bindParam(':subHeadline', $subHeadline);
    $query->bindParam(':textOfNews', $textOfNews);
    $query->bindParam(':newsImg', $newsImg);
    $query->bindParam(':dateOfNews', $dateOfNews);
    $query->bindParam(':typeOfNews', $typeOfNews);
    $query->bindParam(':author', $author);
    $query->bindParam(':newsID', $newsID);

    // go to admin page after update
    if ($query->execute()) {
        header("Location: ../../index.php?page=admin&status=updated&ID=$newsID");
        exit;
    } else {
        echo "Failed to update data. Error: " . implode(", ", $query->errorInfo());
    }

} else {
    header("Location: ../../index.php?page=admin&status=0");
    exit;
}
?>