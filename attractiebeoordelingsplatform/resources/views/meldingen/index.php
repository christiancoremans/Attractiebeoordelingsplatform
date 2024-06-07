<?php
session_start();
if (!isset($_SESSION['username'])) {
    $msg = "Je moet eerst inloggen!";
    header("Location: ../../../login.php");
    exit;
}
?>

<?php require_once __DIR__.'/../../../config/conn.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
</head>

<body>

    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Meldingen</h1>

        <button onclick="window.location.href = 'create.php';">Nieuwe Beoordeling</button>
        <div class="tasks">
        <?php
            require_once '../../../config/conn.php';

            $query = "SELECT ratings.id, ratings.user_id, ratings.attraction_id, ratings.rating, ratings.beschrijving, ratings.created_at, attractions.naam AS attractie 
                      FROM ratings 
                      JOIN attractions ON ratings.attraction_id = attractions.id";

            $statement = $conn->prepare($query); 

            $statement->execute();
            $ratings = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            
            if(isset($ratings) && !empty($ratings)) {
                echo '<p>Aantal beoordelingen: <strong>'.count($ratings).'</strong></p>';
            } else {
                echo '<p>Geen beoordelingen gevonden.</p>';
            }
        ?>
       

        <table>
            <tr>
                <th>Attractie</th>
                <th>Beoordeling</th>
                <th>Beschrijving</th>
                <th>Gebruiker</th>
                <th>Aangemaakt op</th>

            </tr>
            <?php foreach ($ratings as $rating): ?>
                <tr>
                    <td><?php echo $rating['attractie']; ?></td>
                    <td><?php echo $rating['rating']; ?></td>
                    <td><?php echo $rating['beschrijving']; ?></td>
                    <td><?php echo $rating['user_id']; ?></td>
                    <td><?php echo $rating['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>
