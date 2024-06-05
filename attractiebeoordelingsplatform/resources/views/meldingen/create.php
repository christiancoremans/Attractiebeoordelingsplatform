<?php
session_start();
if (!isset($_SESSION['username'])):
    $msg="Je moet eerst inloggen!";
    header("Location: ../../../login.php");
    exit;
endif;
?>


<?php require_once __DIR__.'/../../../config/conn.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen / Nieuw</title>
    <?php require_once __DIR__.'/../components/head.php'; ?>
    <script>
        function validateForm() {
            var attractie = document.getElementById("attractie").value;
            var type = document.getElementById("type").value;
            var capaciteit = document.getElementById("capaciteit").value;
            var melder = document.getElementById("melder").value;

            if (attractie.trim() == "") {
                alert("Vul a.u.b. een attractie in.");
                return false;
            }
            if (type.trim() == "") {
                alert("Kies a.u.b. een type attractie.");
                return false;
            }
            if (isNaN(capaciteit) || capaciteit.trim() == "") {
                alert("Vul a.u.b. een geldige capaciteit in.");
                return false;
            }
            if (melder.trim() == "") {
                alert("Vul a.u.b. een melder in.");
                return false;
            }
            return true; // Als alle validatieregels zijn doorlopen, retourneer true om het formulier te verzenden
        }
    </script>
</head>

<body>
    <?php require_once __DIR__.'/../components/header.php'; ?>

    <div class="container">
        <h1>Nieuwe melding</h1>

        <form action="<?php echo $base_url; ?>/app/Http/Controllers/meldingenController.php" method="POST" onsubmit="return validateForm();">
            <!-- Hidden input voor het actie -->
            <input type="hidden" name="action" value="create">

            <div class="form-group">
                <label for="attractie">Naam attractie:</label>
                <input type="text" name="attractie" id="attractie" class="form-input">
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <select name="type" id="type" class="form-input">
                    <option value="">-- kies een type --</option>
                    <option value="achtbaan">Achtbaan</option>
                    <option value="draaiend">Draaiend</option>
                    <option value="kinder">Kinderattractie</option>
                    <option value="horeca">Horeca</option>
                    <option value="show">Show</option>
                    <option value="water">Water</option>
                    <option value="overig">Overig</option>
                </select>
            </div>
            <div class="form-group">
                <label for="capaciteit">Capaciteit p/uur:</label>
                <input type="number" min="0" name="capaciteit" id="capaciteit" class="form-input">
            </div>
            <div class="form-group">
                <label for="melder">Naam melder:</label>
                <input type="text" name="melder" id="melder" class="form-input">
            </div>
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="number" min="1" name="id" id="id" class="form-input">
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="prioriteit" id="prioriteit">
                    Melding met prioriteit
                </label>
            </div>
            <div class="form-group">
                <label for="overig">Overige info:</label>
                <textarea name="overig" id="overig" class="form-input" rows="4"></textarea>
            </div>

            <input type="submit" value="Verstuur melding">

        </form>
    </div>

</body>

</html>
