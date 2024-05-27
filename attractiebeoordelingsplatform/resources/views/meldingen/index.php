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

        <!-- Form for filters -->
        <form action="" method="GET">
            <!-- Dropdown for filtering by "Type attractie" -->
            <select name="type_filter">
                <option value="">-- Kies type attractie --</option>
                <option value="achtbaan">Achtbaan</option>
                <option value="draaiende">Draaiende attractie</option>
                <option value="kinder">Kinderattractie</option>
                <option value="horeca">Restaurant, cafe, etc. (Horeca)</option>
                <option value="show">Parkshow</option>
                <option value="water">Waterattractie</option>
                <option value="overig">Overig</option>
            </select>
            <!-- Dropdown for filtering by "Melder" -->
            <select name="melder_filter">
                <option value="">-- Kies melder --</option>
                <option value="iedereen">Iedereen</option>
                <option value="mijzelf">Alleen mijzelf</option>
            </select>
            <!-- Submit button to apply filter -->
            <input type="submit" value="Filteren">
        </form>

        <?php
            require_once '../../../config/conn.php';

            // Construct the base query
            $query = "SELECT * FROM meldingen";

            // Check if any filters are set
            if(isset($_GET['type_filter']) && !empty($_GET['type_filter'])) {
                $query .= " WHERE type = :type_filter";
            }
            if(isset($_GET['melder_filter']) && !empty($_GET['melder_filter'])) {
                if(strpos($query, 'WHERE') !== false) {
                    $query .= " AND melder = :melder_filter";
                } else {
                    $query .= " WHERE melder = :melder_filter";
                }
            }

            $statement = $conn->prepare($query); 

            // Bind parameters if filters are set
            if(isset($_GET['type_filter']) && !empty($_GET['type_filter'])) {
                $statement->bindParam(':type_filter', $_GET['type_filter'], PDO::PARAM_STR);
            }
            if(isset($_GET['melder_filter']) && !empty($_GET['melder_filter'])) {
                $statement->bindParam(':melder_filter', $_GET['melder_filter'], PDO::PARAM_STR);
            }

            $statement->execute();
            $meldingen = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            // Check if $meldingen is set and not null
            if(isset($meldingen) && !empty($meldingen)) {
                // Display the number of notifications if $meldingen is not empty
                echo '<p>Aantal meldingen: <strong>'.count($meldingen).'</strong></p>';
            } else {
                // If $meldingen is empty, display a message
                echo '<p>Geen meldingen gevonden.</p>';
            }
        ?>
        <a href="create.php">Nieuwe melding &gt;</a>

        <table>
            <tr>
                <th>Attractie</th>
                <th>Type</th>
                <th>Melder</th>
                <th>Overige info</th>
                <th>Prioriteit</th>
                <th>Capaciteit</th>
                <th>Gemeld op</th>
                <th>Aanpassen</th>
            </tr>
            <?php foreach ($meldingen as $melding): ?>
                <tr>
                    <td><?php echo $melding['attractie']; ?></td>
                    <!-- Types beginnen met hoofdletter -->
                    <td><?php echo ucfirst($melding['type']); ?></td>
                    <td><?php echo $melding['melder']; ?></td>
                    <td><?php echo $melding['overige_info']; ?></td>
                    <td><?php echo ($melding['prioriteit'] == 1) ? 'Ja' : 'Nee'; ?></td>
                    <td><?php echo $melding['capaciteit']; ?></td>
                    <td><?php echo $melding['gemeld_op']; ?></td>
                    <td><a href="../../../edit.php?id=<?php echo $melding['id']; ?>">aanpassen</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

</body>

</html>
