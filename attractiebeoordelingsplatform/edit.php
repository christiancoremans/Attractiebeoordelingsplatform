<?php
session_start();
if (!isset($_SESSION['username'])):
    $msg="Je moet eerst inloggen!";
    header("Location: ../../../login.php");
    exit;
endif;
?>


<?php
require_once __DIR__.'../config/conn.php';

if (!isset($_GET['id'])) {
    echo "Geef in je aanpaslink op de index.php het id van betreffende item mee achter de URL in je a-element om deze pagina werkend te krijgen na invoer van je vijfstappenplan";
    exit;
}

$id = $_GET['id'];

// Prepare and execute query to fetch notification data based on ID
$query = "SELECT * FROM meldingen WHERE id = :id";
$statement = $conn->prepare($query);
$statement->execute([':id' => $id]);
$melding = $statement->fetch(PDO::FETCH_ASSOC);

// Check if notification with the given ID exists
if (!$melding) {
    echo "Melding met ID $id bestaat niet.";
    exit;
}
?>

<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Aanpassen</title>
    <?php require_once 'resources/views/components/head.php'; ?>
</head>

<body>

    <?php require_once 'resources/views/components/header.php'; ?>
    
    <div class="container">
        <h1>Melding aanpassen</h1>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST">
            <!-- Hidden input voor de actie -->
            <input type="hidden" name="action" value="update">
            <!-- Hidden input voor de ID -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="form-group">
                <label>Naam attractie:</label>
                <?php echo $melding['attractie']; ?>
            </div>
            <div class="form-group">
                <label>Type attractie:</label>
                <?php echo $melding['type']; ?>
            </div>
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input" value="<?php echo $melding['capaciteit']; ?>">
            </div>
            <div class="form-group">
                <label for="prioriteit">Prio:</label>
                <input type="checkbox" name="prioriteit" id="prioriteit" <?php echo ($melding['prioriteit'] == 1) ? 'checked' : ''; ?>>
                <label for="prioriteit">Melding met prioriteit</label>
            </div>
            <div class="form-group"> 
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input" value="<?php echo $melding['melder']; ?>">
            </div>
            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"><?php echo $melding['overige_info']; ?></textarea>
            </div>
            
            <input type="submit" value="Melding opslaan">
        </form>

        <hr>

        <!-- Verwijderformulier -->
        <form action="app/Http/Controllers/meldingenController.php" method="POST">
            <!-- Hidden input voor de actie -->
            <input type="hidden" name="action" value="delete">
            <!-- Hidden input voor de ID -->
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" value="Verwijderen">
        </form>
    </div>  
</body>
</html>
