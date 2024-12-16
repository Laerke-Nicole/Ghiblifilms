<?php
require_once "../../includes/dbcon.php";
require_once "../../oop/resizerOOP.php";

if (isset($_POST['submit'])) {
    $name = htmlspecialchars(trim($_POST['Name']));
    $description = htmlspecialchars(trim($_POST['Description']));
    $releaseYear = htmlspecialchars(trim($_POST['ReleaseYear']));
    $duration = htmlspecialchars(trim($_POST['Duration']));

    // img upload
    if (isset($_FILES['movieImg'])) {
        if (($_FILES['movieImg']['type'] == "image/jpeg" ||
            $_FILES['movieImg']['type'] == "image/pjpeg" ||
            $_FILES['movieImg']['type'] == "image/gif" ||
            $_FILES['movieImg']['type'] == "image/png" ||
            $_FILES['movieImg']['type'] == "image/jpg") && 
            ($_FILES['movieImg']['size'] < 600000)) { 

            // if there is an error
            if ($_FILES['movieImg']['error'] > 0) {
                echo "Error: " . $_FILES['movieImg']['error'];
                exit();
            // else upload the file in upload folder
            } else {
                $uploadDir = "../../upload/";
                $uploadedFile = $uploadDir . $_FILES['movieImg']['name'];

                // if the file already exists then dont upload again
                if (file_exists($uploadedFile)) {
                    echo "Can't upload: " . $_FILES['movieImg']['name'] . " exists.";
                    exit();
                } else {
                    // move uploaded file to a temporary location
                    move_uploaded_file($_FILES['movieImg']['tmp_name'], $uploadedFile);

                    // resize the image
                    try {
                        $resizer = new Resizer();
                        $resizer->load($uploadedFile);
                        $resizer->resize(320, 450);
                        $resizer->save($uploadedFile);

                        // get the filename
                        $movieImg = $_FILES['movieImg']['name'];

                        // insert data into the db
                        $query = $dbCon->prepare("INSERT INTO Movie (`Name`, `Description`, ReleaseYear, Duration, MovieImg) VALUES (:name, :description, :releaseYear, :duration, :movieImg)");
                        $query->bindParam(':name', $name);
                        $query->bindParam(':description', $description);
                        $query->bindParam(':releaseYear', $releaseYear);
                        $query->bindParam(':duration', $duration);
                        $query->bindParam(':movieImg', $movieImg);

                        // if the query is successful
                        if ($query->execute()) {
                            header("Location: ../../index.php?page=admin&status=added");
                            exit;
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
    exit;
}