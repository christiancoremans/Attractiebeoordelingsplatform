<?php
session_start();
?>


<!doctype html>
<html lang="nl">

<head>
    <title>Login - StoringApp</title>
    <?php require_once 'resources/views/components/head.php'; ?>
</head>

<body>

    <?php require_once 'resources/views/components/header.php'; ?>
    <div class="container home">
        <h2>Inloggen</h2>
        <form action="<?php echo $base_url; ?>/attractiebeoordelingsplatform/app/Http/Controllers/loginController.php" method="POST">
            <div class="form-group">
                <label for="username">Gebruikersnaam:</label>
                <input type="text" id="username" name="username" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>
            <input type="submit" value="Inloggen" class="btn btn-primary">


            
        </form>
        <div class="registreer">
            <button><a href="register.php" class="register-button" style="text-decoration: none;">Regristeer je</a></button>
        </div>
    </div>

</body>

</html>
