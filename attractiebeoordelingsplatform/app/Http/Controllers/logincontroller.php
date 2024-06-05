<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

require_once '../../../config/conn.php';

$query = "SELECT * FROM users WHERE username = :username";

$statement = $conn->prepare($query);

$statement->execute([
    ':username' => $username
]);

$user = $statement->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    echo 'Wachtwoord is incorrect';
    die();
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['username'] = $user['username'];

header("Location: ../../../resources/views/meldingen/index.php");
?>