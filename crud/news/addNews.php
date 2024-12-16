<?php
require_once "../../includes/dbcon.php";
require_once "../../oop/resizerOOP.php";

if (isset($_POST['submit'])) {
    // Trim and sanitize input fields
    $headline = htmlspecialchars(trim($_POST['Headline']));
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']));
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']));

    // Image upload
    if (isset($_FILES['newsImg'])) {
        if (($_FILES['newsImg']['type'] == "image/jpeg" ||
            $_FILES['newsImg']['type'] == "image/pjpeg" ||
            $_FILES['newsImg']['type'] == "image/gif" ||
            $_FILES['newsImg']['type'] == "image/png" ||
            $_FILES['newsImg']['type'] == "image/jpg") && 
            ($_FILES['newsImg']['size'] < 6000000)) {

            if ($_FILES['newsImg']['error'] > 0) {
                echo "Error: " . $_FILES['newsImg']['error'];
                exit();
            } else {
                $uploadDir = "../../upload/";
                $uploadedFile = $uploadDir . $_FILES['newsImg']['name'];

                if (file_exists($uploadedFile)) {
                    echo "Can't upload: " . $_FILES['newsImg']['name'] . " exists.";
                    exit();
                } else {
                    move_uploaded_file($_FILES['newsImg']['tmp_name'], $uploadedFile);

                    // Resize the image
                    try {
                        $resizer = new Resizer();
                        $resizer->load($uploadedFile);
                        $resizer->resize(320, 450); 
                        $resizer->save($uploadedFile);

                        $newsImg = $_FILES['newsImg']['name'];

                        // Insert data into the database
                        $query = $dbCon->prepare("INSERT INTO News (Headline, SubHeadline, TextOfNews, NewsImg) VALUES (:headline, :subHeadline, :textOfNews, :newsImg)");
                        $query->bindParam(':headline', $headline);
                        $query->bindParam(':subHeadline', $subHeadline);
                        $query->bindParam(':textOfNews', $textOfNews);
                        $query->bindParam(':newsImg', $newsImg);

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
    exit;
}