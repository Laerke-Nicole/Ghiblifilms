<?php
require_once "../../includes/dbcon.php";
require_once "../../oop/resizerOOP.php";

// if the form is submitted
if (isset($_POST['MovieID']) && isset($_POST['submit'])) {
    // get the input values
    $name = htmlspecialchars(trim($_POST['Name']));
    $description = htmlspecialchars(trim($_POST['Description']));
    $releaseYear = htmlspecialchars(trim($_POST['ReleaseYear']));
    $duration = htmlspecialchars(trim($_POST['Duration']));
    $movieID = htmlspecialchars(trim($_POST['MovieID']));

    // initialize the $movieImg variable to store the file name
    $movieImg = null;

    // check if a new image file is uploaded
    if (isset($_FILES['MovieImg']) && $_FILES['MovieImg']['error'] == UPLOAD_ERR_OK) {
        // validate the uploaded file is the right type
        $allowedTypes = ['image/jpeg', 'image/pjpeg', 'image/gif', 'image/png', 'image/jpg'];

        if (in_array($_FILES['MovieImg']['type'], $allowedTypes) && $_FILES['MovieImg']['size'] < 3000000) {
            // move the uploaded file to the "upload" folder
            $movieImg = basename($_FILES['MovieImg']['name']);
            $uploadPath = "../../upload/" . $movieImg;

            if (move_uploaded_file($_FILES['MovieImg']['tmp_name'], $uploadPath)) {
                // resize the uploaded image
                try {
                    $resizer = new Resizer();
                    $resizer->load($uploadPath);
                    // size of the image
                    $resizer->resize(320, 450); 
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

    // update movie data
    $query = $dbCon->prepare("UPDATE Movie SET Name = :name, Description = :description, `ReleaseYear` = :releaseYear, `Duration` = :duration, `MovieImg` = :movieImg WHERE MovieID = :movieID");

    $query->bindParam(':name', $name);
    $query->bindParam(':description', $description);
    $query->bindParam(':releaseYear', $releaseYear);
    $query->bindParam(':duration', $duration);
    $query->bindParam(':movieImg', $movieImg);
    $query->bindParam(':movieID', $movieID);

    // go to admin page after update
    if ($query->execute()) {
        header("Location: ../../index.php?page=admin&status=updated&ID=$movieID");
        exit;
    } else {
        echo "Failed to update data. Error: " . implode(", ", $query->errorInfo());
    }
} else {
    header("Location: ../../index.php?page=admin&status=0");
    exit;
}