<?php
require_once "../../includes/dbcon.php";

if (isset($_POST['submit'])) {
    // Existing field sanitization and validation
    $name = htmlspecialchars(trim($_POST['Name']));
    $description = htmlspecialchars(trim($_POST['Description']));
    $releaseYear = htmlspecialchars(trim($_POST['ReleaseYear']));
    $duration = htmlspecialchars(trim($_POST['Duration']));
    $screenFormatID = htmlspecialchars(trim($_POST['ScreenFormatID']));

    if (isset($_FILES['movieImg']) && ($_FILES['movieImg']['type'] == "image/jpeg" || $_FILES['movieImg']['type'] == "image/pjpeg" || $_FILES['movieImg']['type'] == "image/gif" || $_FILES['movieImg']['type'] == "image/jpg") && ($_FILES['movieImg']['size'] < 3000000)) {
        if ($_FILES['movieImg']['error'] > 0) {
            echo "Error: " . $_FILES['movieImg']['error'];
            exit();
        } else {
            if (file_exists("../upload/" . $_FILES['movieImg']['name'])) {
                echo "File exists.";
                exit();
            } else {
                move_uploaded_file($_FILES['movieImg']['tmp_name'], "../upload/" . $_FILES['movieImg']['name']);
                $movieImg = $_FILES['movieImg']['name'];

                try {
                    $dbCon = dbCon($user, $pass);
                    $dbCon->beginTransaction(); // Start transaction

                    // Insert main movie data
                    $query = $dbCon->prepare("INSERT INTO Movie (`Name`, `Description`, ReleaseYear, Duration, MovieImg, ScreenFormatID) VALUES (:name, :description, :releaseYear, :duration, :movieImg, :screenFormatID)");
                    $query->bindParam(':name', $name);
                    $query->bindParam(':description', $description);
                    $query->bindParam(':releaseYear', $releaseYear);
                    $query->bindParam(':duration', $duration);
                    $query->bindParam(':movieImg', $movieImg);
                    $query->bindParam(':screenFormatID', $screenFormatID);

                    if ($query->execute()) {
                        $movieID = $dbCon->lastInsertId();

                        // Insert selected genres
                        if (!empty($_POST['genres']) && is_array($_POST['genres'])) {
                            foreach ($_POST['genres'] as $genreID) {
                                $genreQuery = $dbCon->prepare("INSERT INTO MovieGenre (MovieID, GenreID) VALUES (:movieID, :genreID)");
                                $genreQuery->bindParam(':movieID', $movieID);
                                $genreQuery->bindParam(':genreID', $genreID);
                                $genreQuery->execute();
                            }
                        }

                        // Insert selected production members
                        if (!empty($_POST['productions']) && is_array($_POST['productions'])) {
                            foreach ($_POST['productions'] as $productionID) {
                                $productionQuery = $dbCon->prepare("INSERT INTO MovieProduction (MovieID, ProductionID) VALUES (:movieID, :productionID)");
                                $productionQuery->bindParam(':movieID', $movieID);
                                $productionQuery->bindParam(':productionID', $productionID);
                                $productionQuery->execute();
                            }
                        }

                        // Insert selected voice actors
                        if (!empty($_POST['voiceactors']) && is_array($_POST['voiceactors'])) {
                            foreach ($_POST['voiceactors'] as $voiceActorID) {
                                $voiceActorQuery = $dbCon->prepare("INSERT INTO MovieVoiceActor (MovieID, VoiceActorID) VALUES (:movieID, :voiceActorID)");
                                $voiceActorQuery->bindParam(':movieID', $movieID);
                                $voiceActorQuery->bindParam(':voiceActorID', $voiceActorID);
                                $voiceActorQuery->execute();
                            }
                        }

                        $dbCon->commit(); // Commit transaction
                        header("Location: ../../index.php?page=admin&status=added");
                    } else {
                        echo "Failed to insert movie data.";
                    }
                } catch (PDOException $e) {
                    $dbCon->rollBack(); // Rollback on error
                    echo "Database error: " . $e->getMessage();
                }
            }
        }
    } else {
        echo "Invalid file type or size.";
    }
} else {
    header("Location: ../../index.php?page=admin&status=0");
}
