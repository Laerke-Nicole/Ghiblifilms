<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['MovieID']) && isset($_POST['submit'])) {
    // Get the input values
    $name = htmlspecialchars(trim($_POST['Name']));
    $description = htmlspecialchars(trim($_POST['Description']));
    $releaseYear = htmlspecialchars(trim($_POST['ReleaseYear']));
    $duration = htmlspecialchars(trim($_POST['Duration']));
    $screenFormatID = htmlspecialchars(trim($_POST['ScreenFormatID']));
    $movieID = htmlspecialchars(trim($_POST['MovieID']));

    $dbCon = dbCon($user, $pass);

    // Initialize the $movieImg variable
    $movieImg = null;

    // Check if a new image file is uploaded
    if (isset($_FILES['MovieImg']) && $_FILES['MovieImg']['error'] == UPLOAD_ERR_OK) {
        // Validate the uploaded file (type and size)
        $allowedTypes = ['image/jpeg', 'image/pjpeg', 'image/gif', 'image/jpg'];
        
        if (in_array($_FILES['MovieImg']['type'], $allowedTypes) && $_FILES['MovieImg']['size'] < 3000000) {
            // Move the uploaded file to the "upload" directory
            $movieImg = basename($_FILES['MovieImg']['name']);
            $uploadPath = "../../upload/" . $movieImg;

            if (!move_uploaded_file($_FILES['MovieImg']['tmp_name'], $uploadPath)) {
                echo "Failed to move uploaded file.";
                exit();
            }
        } else {
            echo "Invalid file type or file size too large.";
            exit();
        }
    } else {
        // If no new image is uploaded, keep the existing one
        $query = $dbCon->prepare("SELECT MovieImg FROM Movie WHERE MovieID = :movieID");
        $query->bindParam(':movieID', $movieID);
        $query->execute();
        $movieImg = $query->fetchColumn(); // Fetch the current image file name
    }

    // Update the movie record
    $query = $dbCon->prepare("UPDATE Movie SET Name = :name, Description = :description, `ReleaseYear` = :releaseYear, `Duration` = :duration, `MovieImg` = :movieImg, `ScreenFormatID` = :screenFormatID WHERE MovieID = :movieID");

    $query->bindParam(':name', $name);
    $query->bindParam(':description', $description);
    $query->bindParam(':releaseYear', $releaseYear);
    $query->bindParam(':duration', $duration);
    $query->bindParam(':movieImg', $movieImg);
    $query->bindParam(':screenFormatID', $screenFormatID);
    $query->bindParam(':movieID', $movieID);

    // Execute the query and check for success
    if ($query->execute()) {
        header("Location: ../../index.php?page=admin&status=updated&ID=$movieID");
    } else {
        echo "Failed to update data. Error: " . implode(", ", $query->errorInfo());
    }
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
?>
