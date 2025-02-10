// Démarrer les animations une fois la page complètement chargée
document.addEventListener('DOMContentLoaded', () => {
    animerAuDefilement();
});

// Ajout d'une navigation fluide pour les ancres
// Permet de scroller en douceur vers les sections correspondantes
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth' // Défilement fluide
        });
    });
});

// Effet de flou sur le header lorsque l'on scroll
window.addEventListener("scroll", function () {
    const navigation = document.querySelector(".navigation");
    if (window.scrollY > 50) { // Si l'utilisateur scrolle de plus de 50 pixels
        navigation.classList.add("scrolled"); // Ajoute la classe qui applique l'effet
    } else {
        navigation.classList.remove("scrolled"); // Retire la classe si on remonte en haut
    }
});

// Gestion de la barre latérale (sidebar) des réseaux sociaux
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.querySelector(".sidebar-reseaux");
    const toggleBtn = document.querySelector(".toggle-sidebar");

    // Ajoute un événement au bouton pour afficher/masquer la sidebar
    toggleBtn.addEventListener("click", function() {
        sidebar.classList.toggle("sidebar-cachee"); // Alterne entre affiché et caché
        console.log("Classes actuelles :", sidebar.classList); // Vérification console
    });
});

// Fonction pour animer les éléments au défilement
function animerAuDefilement() {
    // sélectionne tous les éléments ayant les classes spécifiques à animer
    const elements = document.querySelectorAll('.carte, .carte-projet, .skill-card');

    // observateur qui détecte l'apparition des éléments dans le viewport
    const observateur = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) { // vérifie si l'élément est visible à l'écran
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 }); // se déclenche lorsque 10% de l'élément est visible

    // applique un style initial aux éléments et les observe
    elements.forEach(element => {
        element.style.opacity = '0'; // rend l'élément invisible au départ
        element.style.transform = 'translateY(20px)'; // positionne légèrement en bas
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease'; // animation fluide
        observateur.observe(element); // ajoute l'élément à l'observateur
    });
}

// Fonction pour retourner les cartes de projets en cliquant dessus
function flipCard(card) {
    card.classList.toggle('flipped'); // Ajoute ou enlève la classe "flipped" pour l'animation
}
