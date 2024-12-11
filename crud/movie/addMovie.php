<?php
require_once "../../includes/dbcon.php";
require_once "../../oop/resizerOOP.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars for input fields
    $name = htmlspecialchars(trim($_POST['Name']));
    $description = htmlspecialchars(trim($_POST['Description']));
    $releaseYear = htmlspecialchars(trim($_POST['ReleaseYear']));
    $duration = htmlspecialchars(trim($_POST['Duration']));

    // Image upload
    if (isset($_FILES['movieImg'])) {
        if (($_FILES['movieImg']['type'] == "image/jpeg" ||
            $_FILES['movieImg']['type'] == "image/pjpeg" ||
            $_FILES['movieImg']['type'] == "image/gif" ||
            $_FILES['movieImg']['type'] == "image/png" ||
            $_FILES['movieImg']['type'] == "image/jpg") && 
            ($_FILES['movieImg']['size'] < 600000)) { 

            if ($_FILES['movieImg']['error'] > 0) {
                echo "Error: " . $_FILES['movieImg']['error'];
                exit(); // Stop further execution
            } else {
                $uploadDir = "../../upload/";
                $uploadedFile = $uploadDir . $_FILES['movieImg']['name'];

                // Check if file exists
                if (file_exists($uploadedFile)) {
                    echo "Can't upload: " . $_FILES['movieImg']['name'] . " exists.";
                    exit(); // Stop further execution
                } else {
                    // Move uploaded file to a temporary location
                    move_uploaded_file($_FILES['movieImg']['tmp_name'], $uploadedFile);

                    // Resize the image
                    try {
                        $resizer = new Resizer();
                        $resizer->load($uploadedFile);
                        $resizer->resize(320, 450);
                        $resizer->save($uploadedFile);

                        // get the filename
                        $movieImg = $_FILES['movieImg']['name'];

                        // Insert data into the database
                        $query = $dbCon->prepare("INSERT INTO Movie (`Name`, `Description`, ReleaseYear, Duration, MovieImg) VALUES (:name, :description, :releaseYear, :duration, :movieImg)");
                        $query->bindParam(':name', $name);
                        $query->bindParam(':description', $description);
                        $query->bindParam(':releaseYear', $releaseYear);
                        $query->bindParam(':duration', $duration);
                        $query->bindParam(':movieImg', $movieImg);

                        // Execute and check for errors
                        if ($query->execute()) {
                            header("Location: ../../index.php?page=admin&status=added");
                        } else {
                            echo "Failed to insert data. Error: " . implode(", ", $query->errorInfo());
                        }
                    } catch (Exception $e) {
                        echo "Error resizing image: " . $e->getMessage();
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