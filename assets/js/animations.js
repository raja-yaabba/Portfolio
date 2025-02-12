// Démarrer les animations une fois la page complètement chargée
document.addEventListener('DOMContentLoaded', () => {
    animerAuDefilement();
    initContactForm(); // initialisation du formulaire en AJAX
});

// Ajout d'une navigation fluide pour les ancres
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Effet de flou sur le header lorsque l'on scroll
window.addEventListener("scroll", function () {
    const navigation = document.querySelector(".navigation");
    if (window.scrollY > 50) {
        navigation.classList.add("scrolled");
    } else {
        navigation.classList.remove("scrolled");
    }
});

// Gestion de la barre latérale des réseaux sociaux
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar-reseaux");
    const toggleBtn = document.querySelector(".toggle-sidebar");

    toggleBtn.addEventListener("click", function () {
        sidebar.classList.toggle("sidebar-cachee");
        console.log("Classes actuelles :", sidebar.classList);
    });
});

// Fonction pour animer les éléments au défilement
function animerAuDefilement() {
    const elements = document.querySelectorAll('.carte, .carte-projet, .skill-card');

    const observateur = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    elements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observateur.observe(element);
    });
}

// Formulaire de contact : envoi des données en AJAX
function initContactForm() {
    const form = document.querySelector(".formulaire-contact");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        const messageStatus = document.querySelector(".message-status");

        fetch(form.action, {
            method: "POST",
            body: formData
        })
        .then(response => response.json()) // on attend une réponse JSON du serveur
        .then(data => {
            messageStatus.innerHTML = data.message;
            messageStatus.classList.add(data.status === "success" ? "success-message" : "error-message");
        })
        .catch(error => {
            messageStatus.innerHTML = "Erreur lors de l'envoi du message.";
            messageStatus.classList.add("error-message");
            console.error("Erreur d'envoi :", error);
        });
    });
}

// Fonction pour retourner les cartes de projets en cliquant dessus
function flipCard(card) {
    card.classList.toggle('flipped');
}
