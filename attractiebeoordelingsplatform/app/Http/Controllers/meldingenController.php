<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];

    if ($action == "create") {
        $attractie = $_POST['attractie'];
        $type = $_POST['type'];
        $capaciteit = $_POST['capaciteit'];
        $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
        $melder = $_POST['melder'];
        $overig = $_POST['overig'];

        $errors = [];
        if (empty($attractie)) {
            $errors[] = "Vul de attractie-naam in.";
        }
        if (empty($type)) {
            $errors[] = "Kies een type.";
        }
        if (!is_numeric($capaciteit)) {
            $errors[] = "Vul voor capaciteit een geldig getal in.";
        }
        if (empty($melder)) {
            $errors[] = "Vul de naam van de melder in.";
        }

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            exit;
        }

        require_once __DIR__ . '/../../../config/conn.php';

        $query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info) VALUES (:attractie, :type, :capaciteit, :prioriteit, :melder, :overig)";

        $statement = $conn->prepare($query);

        $statement->execute([
            ":attractie" => $attractie,
            ":type" => $type,
            ":capaciteit" => $capaciteit,
            ":prioriteit" => $prioriteit,
            ":melder" => $melder,
            ":overig" => $overig,
        ]);

        header("Location: ../../../resources/views/meldingen/index.php");
        exit;
    }

    if ($action == "update") {
        $id = $_POST['id'];
        $capaciteit = $_POST['capaciteit'];
        $prioriteit = isset($_POST['prioriteit']) ? 1 : 0;
        $melder = $_POST['melder'];
        $overig = $_POST['overig'];

        require_once __DIR__ . '/../../../config/conn.php';

        $query = "UPDATE meldingen SET capaciteit=:capaciteit, prioriteit=:prioriteit, melder=:melder, overige_info=:overig WHERE id = :id";

        $statement = $conn->prepare($query);

        $statement->execute([
            ":capaciteit" => $capaciteit,
            ":prioriteit" => $prioriteit,
            ":melder" => $melder,
            ":overig" => $overig,
            ":id" => $id
        ]);

        header("Location: ../../../resources/views/meldingen/index.php");
        exit;
    }

    if ($action == "delete") {
        // Check if ID is set and numeric
        if (isset($_POST['id']) && is_numeric($_POST['id'])) {
            $id = $_POST['id'];

            require_once __DIR__ . '/../../../config/conn.php';

            // Prepare and execute DELETE query
            $query = "DELETE FROM meldingen WHERE id = :id";
            $statement = $conn->prepare($query);
            $statement->execute([':id' => $id]);

            // Redirect to index.php after deletion
            header("Location: ../../../resources/views/meldingen/index.php");
            exit;
        } else {
            // If ID is not set or not numeric, redirect to index.php
            header("Location: ../../../resources/views/meldingen/index.php");
            exit;
        }
    }
}
?>
