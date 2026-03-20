<!DOCTYPE html>
<html lang="fr">

<head>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Promo</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap"
            rel="stylesheet" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/perso.css" />
    </head>

<body>
    <header>
        <nav class="navbar">
            <div class="logo">S<span>cholia</span></div>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <li><a href="promotion.php">Promotion</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="administration.php" class="btn-nav">Administration</a></li>
            </ul>
        </nav>

    </header>

    <div>
        <?php echo $content ?>
    </div>
    <footer class="site-footer">
        <div>
            <div class="footer-logo">S<span>CHOLIA</span></div>
            <div class="footer-sub">Centre de Formation en Alternance</div>
        </div>
        <div class="footer-info">
            Tour Europa, 9 Avenue de l'Europe, 94320 Thiais<br />
            NDA : 11 75 65673 75 · Siret : 914 873 641 00015<br />
            <a href="tel:+33756866869">+33 (0)7 56 86 68 69</a> ·
            <a href="mailto:contact@scholia.fr">contact@scholia.fr</a> ·
            <a href="https://www.scholia.fr" target="_blank">www.scholia.fr</a>
        </div>
    </footer>
</body>

</html>