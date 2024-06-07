<?php
session_start();

$naam = $_POST['naam'];
$username = $_POST['username'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];

require_once '../../../config/conn.php';

if ($password == $cpassword) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
} else {
    echo 'Wachtwoorden komen niet overeen';
    die();
}

$query = "INSERT INTO users (naam, username, password) VALUES (:naam, :username, :hash)";

$statement = $conn->prepare($query);

$statement->execute([
    ':naam' => $naam,
    ':username' => $username,
    ':hash' => $hash
]);

$_SESSION['user_id'] = $id;
$_SESSION['naam'] = $naam;

header("Location: ../../../resources/views/meldingen/index.php");
