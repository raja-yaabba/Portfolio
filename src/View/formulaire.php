<?php
use App\Portfolio\Controller\ContactController;

$contactController = new ContactController();
?>

<div class="contenu">
    <h2 class="section-title">Me contacter</h2>

    <div class="contact-container">
        <!-- Message de statut ajouté ici -->
        <div class="message-status"></div>

        <!-- Formulaire -->
        <form id="contactForm" class="formulaire-contact">
            <div class="groupe-form">
                <label for="nom">Nom*</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
            </div>
            <div class="groupe-form">
                <label for="email">Email*</label>
                <input type="email" id="email" name="email" placeholder="nom@exemple.com" required>
            </div>
            <div class="groupe-form">
                <label for="message">Message*</label>
                <textarea id="message" name="message" rows="4" placeholder="Votre message" required></textarea>
            </div>
            <button type="submit" class="bouton-principal">Envoyer</button>
        </form>

        <!-- Vidéo intégrée et texte -->
        <div class="videoettexte">
            <div class="video-container">
                <iframe src="https://www.youtube.com/embed/QGwTGwNsQHQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <p class="video-caption">En attendant votre message, profitez d’un instant musical pour vous inspirer.</p>
        </div>
    </div>
</div>
