<?php
session_start();
if (!isset($_SESSION['username'])):
    $msg = "Je moet eerst inloggen!";
    header("Location: ../../../login.php");
    exit;
endif;

require_once __DIR__.'/../../../config/conn.php';

$attractions_query = "SELECT id, naam, beschrijving FROM attractions";
$attractions_stmt = $conn->prepare($attractions_query);
$attractions_stmt->execute();
$attractions = $attractions_stmt->fetchAll(PDO::FETCH_ASSOC);

if ($attractions === false) {
    echo "Error fetching attractions: " . $conn->errorInfo()[2];
    exit;
}
?>

<!doctype html>
<html lang="nl">

<head>
    <title>Attractie Beoordeling / Nieuwe Beoordeling</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
    <script>
        function validateForm() {
            var attraction_id = document.getElementById("attraction_id").value;
            var rating = document.getElementById("rating").value;
            var beschrijving = document.getElementById("beschrijving").value;

            if (attraction_id.trim() == "") {
                alert("Kies a.u.b. een attractie.");
                return false;
            }
            if (isNaN(rating) || rating.trim() == "" || rating < 1 || rating > 10) {
                alert("Vul a.u.b. een geldige beoordeling in (1-10).");
                return false;
            }
            if (beschrijving.trim() == "") {
                alert("Vul a.u.b. een beschrijving in.");
                return false;
            }
            return true; 
        }
    </script>
</head>

<body>
    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuwe Beoordeling</h1>
        <form action="<?php echo $base_url; ?>/attractiebeoordelingsplatform/app/Http/Controllers/meldingenController.php" method="POST" onsubmit="return validateForm();">
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="attraction_id">Naam attractie:</label>
                <select name="attraction_id" id="attraction_id" class="form-input">
                    <option value="">-- kies een attractie --</option>
                    <?php foreach($attractions as $attraction): ?>
                        <option value="<?php echo $attraction['id']; ?>"><?php echo $attraction['naam']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="rating">Beoordeling (1-10):</label>
                <input type="number" min="1" max="10" name="rating" id="rating" class="form-input">
            </div>
            <div class="form-group">
                <label for="beschrijving">Beschrijving:</label>
                <textarea name="beschrijving" id="beschrijving" class="form-input" rows="4"></textarea>
            </div>

            <input type="submit" value="Verstuur Beoordeling">
        </form>
    </div>
</body>

</html>
