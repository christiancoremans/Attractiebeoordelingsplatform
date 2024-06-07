<?php
session_start(); // Start the session
?>

<?php require_once __DIR__ . '/config/conn.php'; ?>
<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp / Meldingen</title>
    <?php require_once __DIR__ . '/resources/views/components/head.php'; ?>
</head>

<body>
    <div class="regirster-form">
        <?php require_once __DIR__ . '/resources/views/components/header.php'; ?>

        <form action="app/Http/Controllers/registerController.php" method="POST" class="login">

            <h1>Regristeer jezelf bij attractiebeoordelingsplatform</h1>

            <div class="form-group">
                <label for="naam">Naam</label>
                <input type="text" name="naam" placeholder="naam">
            </div>

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="password">
            </div>

            <div class="form-group">
                <label for="cpassword">Herhaal password</label>
                <input type="password" name="cpassword" placeholder="password">
            </div>
            
            <div class="form-submit">
                <input type="submit" value="Regristeer je" class="form-submit" style="cursor: pointer;">
            </div>

        </form>
    </div>
    </div>
</body>

</html>
