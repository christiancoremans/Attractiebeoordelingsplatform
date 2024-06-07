<?php require_once __DIR__.'/../../../config/conn.php'; ?>

<header>
    <div class="container">
        <nav>
            <img src="<?php echo $base_url; ?>/attractiebeoordelingsplatform/public_html/img/logo-big-v4.png" alt="logo" class="logo">
            <a href="<?php echo $base_url; ?>/attractiebeoordelingsplatform/index.php">Home</a> |
            <a href="<?php echo $base_url; ?>/attractiebeoordelingsplatform/resources/views/meldingen/index.php">Meldingen</a>
           
        </nav>
        <div>
        <?php 
        if(isset($_SESSION['username']) == true): ?><p><a href="<?php echo $base_url; ?>/attractiebeoordelingsplatform/logout.php">Uitloggen</a></p>
        <?php else: ?><p><a href="<?php echo $base_url; ?>/attractiebeoordelingsplatform/login.php">Inloggen</a></p>
        <?php endif; ?>
        </div>
    </div>
    
</header>
<?php
