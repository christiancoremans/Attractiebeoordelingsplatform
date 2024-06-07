<?php
session_start();

if (!isset($_SESSION['username'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../../../login.php");
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in the session.";
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "create") {
        $attraction_id = $_POST['attraction_id'];
        $rating = $_POST['rating'];
        $beschrijving = $_POST['beschrijving'];

        $errors = [];
        if (empty($attraction_id)) {
            $errors[] = "Kies een attractie.";
        }
        if (!is_numeric($rating) || $rating < 1 || $rating > 10) {
            $errors[] = "Vul een geldige beoordeling in (1-10).";
        }
        if (empty($beschrijving)) {
            $errors[] = "Vul een beschrijving in.";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            exit;
        }

        require_once __DIR__ . '/../../../config/conn.php';

        $query = "INSERT INTO ratings (user_id, attraction_id, rating, beschrijving, created_at) VALUES (:user_id, :attraction_id, :rating, :beschrijving, NOW())";

        $statement = $conn->prepare($query);

        try {
            $statement->execute([
                ":user_id" => $user_id,
                ":attraction_id" => $attraction_id,
                ":rating" => $rating,
                ":beschrijving" => $beschrijving,
            ]);
        } catch (PDOException $e) {
            echo "Error inserting rating: " . $e->getMessage();
            exit;
        }

        header("Location: ../../../resources/views/meldingen/index.php");
        exit;
    }}