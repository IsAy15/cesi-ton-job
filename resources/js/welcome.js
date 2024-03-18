// Attend que le document soit prêt
document.addEventListener("DOMContentLoaded", function () {
    // Récupère les éléments HTML nécessaires
    var header = document.querySelector("header");
    var main = document.querySelector("main");
    var welcomeText = document.querySelector(".welcome");

    // Fonction pour gérer le défilement
    function handleScroll() {
        // Récupère la position actuelle de la fenêtre
        var scrollPosition = window.scrollY;

        // Si le scroll dépasse le texte de bienvenue
        if (scrollPosition > welcomeText.offsetHeight / 1.5) {
            // Ajoute la classe "scrolled" au header
            header.classList.add("scrolled");
        } else {
            // Sinon, retire la classe "scrolled" du header
            header.classList.remove("scrolled");
        }

        // if (scrollPosition > 0) {
        //   header.classList.add("scrolled");
        // } else {
        //   header.classList.remove("scrolled");
        // }

        // // Si l'utilisateur a fait défiler plus que la moitié de la hauteur de la section de démarrage
        // if (scrollPosition > startSection.offsetHeight / 1) {
        //     // Cache la section de démarrage
        //     startSection.style.opacity = '0';
        //     startSection.style.transition = 'opacity 0.5s ease';

        //     // Affiche progressivement le header
        //     header.style.opacity = '1';
        // } else {
        //     // Sinon, montre la section de démarrage
        //     startSection.style.opacity = '1';
        //     startSection.style.transition = 'opacity 0.5s ease';

        //     // Cache le header
        //     header.style.opacity = '0';
        // }
    }

    // Écoute l'événement de défilement et appelle la fonction de gestion du défilement
    window.addEventListener("scroll", handleScroll);
});
