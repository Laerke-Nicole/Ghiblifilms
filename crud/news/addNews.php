<?php
require_once "../../includes/dbcon.php";
require_once "../../oop/resizerOOP.php";

if (isset($_POST['submit'])) {
    $headline = htmlspecialchars(trim($_POST['Headline']));
    $subHeadline = htmlspecialchars(trim($_POST['SubHeadline']));
    $textOfNews = htmlspecialchars(trim($_POST['TextOfNews']));
    $dateOfNews = htmlspecialchars(trim($_POST['DateOfNews']));
    $typeOfNews = htmlspecialchars(trim($_POST['TypeOfNews']));
    $author = htmlspecialchars(trim($_POST['Author']));

    // img upload
    if (isset($_FILES['newsImg'])) {
        if (($_FILES['newsImg']['type'] == "image/jpeg" ||
            $_FILES['newsImg']['type'] == "image/pjpeg" ||
            $_FILES['newsImg']['type'] == "image/gif" ||
            $_FILES['newsImg']['type'] == "image/png" ||
            $_FILES['newsImg']['type'] == "image/jpg") && 
            ($_FILES['newsImg']['size'] < 6000000)) {

            // if there is an error
            if ($_FILES['newsImg']['error'] > 0) {
                echo "Error: " . $_FILES['newsImg']['error'];
                exit();
            // else upload the file in upload folder
            } else {
                $uploadDir = "../../upload/";
                $uploadedFile = $uploadDir . $_FILES['newsImg']['name'];

                // if the file already exists then dont upload again
                if (file_exists($uploadedFile)) {
                    echo "Can't upload: " . $_FILES['newsImg']['name'] . " exists.";
                    exit();
                } else {
                    // move uploaded file to a temporary location
                    move_uploaded_file($_FILES['newsImg']['tmp_name'], $uploadedFile);

                    // resize the image
                    try {
                        $resizer = new Resizer();
                        $resizer->load($uploadedFile);
                        $resizer->resize(450, 320); 
                        $resizer->save($uploadedFile);

                        // get the filename
                        $newsImg = $_FILES['newsImg']['name'];

                        // insert data into the db
                        $query = $dbCon->prepare("INSERT INTO News (Headline, SubHeadline, TextOfNews, NewsImg, DateOfNews, TypeOfNews, Author) VALUES (:headline, :subHeadline, :textOfNews, :newsImg, :dateOfNews, :typeOfNews, :author)");
                        $query->bindParam(':headline', $headline);
                        $query->bindParam(':subHeadline', $subHeadline);
                        $query->bindParam(':textOfNews', $textOfNews);
                        $query->bindParam(':newsImg', $newsImg);
                        $query->bindParam(':dateOfNews', $dateOfNews);
                        $query->bindParam(':typeOfNews', $typeOfNews);
                        $query->bindParam(':author', $author);

                        // if the query is successful
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