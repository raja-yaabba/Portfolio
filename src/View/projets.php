<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Projets</title>
</head>
<body>
    <div class="page-container">
        <section class="projets-section">
            <h2 class="section-title">Mes Projets</h2>
            <p class="section-subtitle">Appuyez sur les cartes pour en savoir plus!</p>
            <div class="contenu">
                <div class="grille-projets">
                    <!-- Carte Projet 1 -->
                    <div class="carte-projet" onclick="flipCard(this)">
                        <div class="carte-interieur">
                            <div class="carte-avant">
                                <h3>Gestion de Trajets</h3>
                                <!-- Langages utilisés lors de ce projet -->
                                <div class="langages-list">
                                    <span class="langage-tag langage-php">PHP</span>
                                    <span class="langage-tag langage-html">HTML</span>
                                    <span class="langage-tag langage-css">CSS</span>
                                </div>
                            </div>
                            <div class="carte-arriere">
                                <ul>
                                    <li>Système interactif permettant la création, modification et suivi des trajets en temps réel.</li>                                    </li>
                                    <li>Sessions et cookies pour personnaliser l’expérience utilisateur et stocker les préférences.</li>
                                </ul>
                                <a href="https://github.com/raja-yaabba/gestion-trajets-php" target="_blank" class="bouton-github">
                                    <img src="/portfolio/assets/img/github2.svg" alt="GitHub" class="github-logo">
                                    Voir le code
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Carte Projet 2 -->
                    <div class="carte-projet" onclick="flipCard(this)">
                        <div class="carte-interieur">
                            <div class="carte-avant">
                                <h3>Températures cours d'eau</h3>
                                <!-- Langages utilisés -->
                                <div class="langages-list">
                                    <span class="langage-tag langage-python">Python</span>
                                    <span class="langage-tag langage-html">HTML</span>
                                    <span class="langage-tag langage-css">CSS</span>
                                </div>
                            </div>
                            <div class="carte-arriere">
                                <ul>
                                    <li>Analyse des variations de température des cours d’eau en France.</li>
                                    <li>Visualisation interactive des données officielles.</li>
                                    <li>Interface intuitive pour explorer les relevés en temps réel.</li>
                                </ul>
                                <a href="https://github.com/raja-yaabba/temperature-cours-deau" target="_blank" class="bouton-github">
                                    <img src="/portfolio/assets/img/github2.svg" alt="GitHub" class="github-logo">
                                    Voir le code
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Carte Projet 3 -->
                    <div class="carte-projet" onclick="flipCard(this)">
                        <div class="carte-interieur">
                            <div class="carte-avant">
                                <h3>Site Touristique Porto Santo</h3>
                                <!-- Langages utilisés -->
                                <div class="langages-list">
                                    <span class="langage-tag langage-html">HTML</span>
                                    <span class="langage-tag langage-css">CSS</span>
                                </div>
                            </div>
                            <div class="carte-arriere">
                                <ul>
                                    <li>Promotion touristique de Porto Santo à travers un site attractif et visuel.</li>
                                    <li>Navigation intuitive avec menu déroulant et sessions dédiées aux activités locales.</li>
                                </ul>
                                <a href="https://github.com/raja-yaabba/SiteTouristiquePortoSanto" target="_blank" class="bouton-github">
                                    <img src="/portfolio/assets/img/github2.svg" alt="GitHub" class="github-logo">
                                    Voir le code
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
</html>