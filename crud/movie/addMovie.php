<?php
require_once "../../includes/dbcon.php";

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
            $_FILES['movieImg']['type'] == "image/jpg") && 
            ($_FILES['movieImg']['size'] < 600000)) { 

            if ($_FILES['movieImg']['error'] > 0) {
                echo "Error: " . $_FILES['movieImg']['error'];
                exit(); // Stop further execution
            } else {
                // Check if file exists
                if (file_exists("../upload/" . $_FILES['movieImg']['name'])) {
                    echo "Can't upload: " . $_FILES['movieImg']['name'] . " exists.";
                    exit(); // Stop further execution
                } else {
                    // Move uploaded file to the "upload" directory
                    move_uploaded_file($_FILES['movieImg']['tmp_name'], "../../upload/" . $_FILES['movieImg']['name']);
                    $movieImg = $_FILES['movieImg']['name']; // Get the filename

                    // Insert data into the database
                    try {
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