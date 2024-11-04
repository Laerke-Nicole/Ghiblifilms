<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Trim and htmlspecialchars for input fields
    $name = htmlspecialchars(trim($_POST['Name']), ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars(trim($_POST['Description']), ENT_QUOTES, 'UTF-8');
    $releaseYear = htmlspecialchars(trim($_POST['ReleaseYear']), ENT_QUOTES, 'UTF-8');
    $duration = htmlspecialchars(trim($_POST['Duration']), ENT_QUOTES, 'UTF-8');
    $screenFormatID = htmlspecialchars(trim($_POST['ScreenFormatID']), ENT_QUOTES, 'UTF-8');

    // Image upload
    if (isset($_FILES['movieImg'])) {
        if (($_FILES['movieImg']['type'] == "image/jpeg" ||
            $_FILES['movieImg']['type'] == "image/pjpeg" ||
            $_FILES['movieImg']['type'] == "image/gif" ||
            $_FILES['movieImg']['type'] == "image/jpg") && 
            ($_FILES['movieImg']['size'] < 3000000)) { 

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
                    move_uploaded_file($_FILES['movieImg']['tmp_name'], "../upload/" . $_FILES['movieImg']['name']);
                    $movieImg = $_FILES['movieImg']['name']; // Get the filename

                    // Insert data into the database
                    try {
                        $dbCon = dbCon($user, $pass);
                        $query = $dbCon->prepare("INSERT INTO Movie (`Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) VALUES (:name, :description, :releaseYear, :duration, :movieImg, :screenFormatID)");
                        $query->bindParam(':name', $name);
                        $query->bindParam(':description', $description);
                        $query->bindParam(':releaseYear', $releaseYear);
                        $query->bindParam(':duration', $duration);
                        $query->bindParam(':movieImg', $movieImg);
                        $query->bindParam(':screenFormatID', $screenFormatID);
                        
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
        }
    } else {
        echo "No file was uploaded.";
    }

} else {
    header("Location: ../../index.php?page=admin&status=0");
}