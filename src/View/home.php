<?php
// Configuration de base
$titre = "Mon Portfolio";
$description = "Portfolio personnel";
$auteur = "Portfolio";

// Inclure le contrôleur de contact
require_once __DIR__ . '/../Controller/ContactController.php';
use App\Portfolio\Controller\ContactController;

$contactController = new ContactController();
?>

<!-- Section Accueil -->
<section id="accueil" class="accueil">
    <div class="contenu">
        <h1 class="titre-principal">Bonjour, je m'appelle Raja et voici mon portfolio...</h1>
        <p class="sous-titre">─ ⊹ ⊱ ☆ ⊰ ⊹ ─ <br> Étudiante en BUT Informatique </p>
        <a href="?action=home#apropos" class="bouton-principal" >En savoir plus</a>
    </div>
</section>

<!-- Section À propos -->
<section id="apropos" class="apropos">
    <?php include 'apropos.php'; ?>
</section>

<!-- Section Compétences -->
<section id="competences" class="competences">
    <?php include 'competences.php'; ?>
</section>

<!-- Section Projets -->
<section id="projets" class="projets">
    <?php include 'projets.php'; ?>
</section>

<!-- Section Contact -->
<section id="contact" class="contact">
    <?php include 'formulaire.php'; ?>
</section>