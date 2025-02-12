<?php
// Configuration de base
$titre = "Raja Y. | Portfolio";
$description = "Portfolio personnel";
$auteur = "Raja Y.";
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo htmlspecialchars($titre); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($description); ?>" />
    <meta name="author" content="<?php echo htmlspecialchars($auteur); ?>" />
    <meta property="og:image" content="/assets/img/og-image.png" />
    <link rel="icon" href="/assets/img/logo.png" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navigation">
        <div class="nav-contenu">
            <a href="?action=home#accueil" class="logo">
                <img src="/portfolio/assets/img/logo.png" alt="Logo">
            </a>
            <div class="menu">
                <a href="?action=home#accueil">Accueil</a>
                <a href="?action=home#apropos">À propos</a>
                <a href="?action=home#competences">Compétences</a>
                <a href="?action=home#projets">Projets</a>
                <a href="?action=home#contact">Contact</a>
            </div>
            <!-- Bouton Exporter mon CV -->
            <a href="/portfolio/assets/pdf/CV_YAABBA.pdf" download class="export-button">
                <i class="fa-solid fa-download"></i>
                <span>Exporter mon CV</span>
            </a>
        </div>
    </nav>

    <!-- Contenu dynamique -->
    <main>
        <?php require $cheminVueBody; ?>
    </main>

    <!-- Sidebar Réseaux Sociaux -->
    <div class="sidebar-reseaux sidebar-visible">
        <a href="https://www.linkedin.com/in/raja-yaabba/" target="_blank" aria-label="LinkedIn">
            <img src="/portfolio/assets/img/linkedin.svg" alt="LinkedIn">
        </a>
        <a href="https://github.com/raja-yaabba" target="_blank" aria-label="GitHub">
            <img src="/portfolio/assets/img/github.svg" alt="GitHub">
        </a>
    </div>

    <!-- Bouton flèche -->
    <button class="toggle-sidebar" aria-label="Cacher la sidebar">&#x276F;</button>

    <!-- Footer -->
    <footer class="footer">
        <div class="contenu">
            <p>&copy; <?php echo date("Y"); ?> • Réalisé par Raja Y.</p>
        </div>
    </footer>

    <script src="/portfolio/assets/js/animations.js"></script>
</body>
</html>
