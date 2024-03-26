import Typed from "typed.js";

// Attend que le document soit prêt
document.addEventListener("DOMContentLoaded", function () {
    // Header
    // Récupère les éléments HTML nécessaires
    var header = document.querySelector("header");
    // Fonction pour gérer le défilement
    function handleScroll() {
        var scrollPosition = window.scrollY;

        if (
            scrollPosition > 0 &&
            header.offsetTop == Math.round(scrollPosition) &&
            !header.classList.contains("scrolled")
        ) {
            header.classList.add("scrolled");
            console.log("scrolled");
            header.style.marginBottom = "9rem";
            //window.scrollY = 2;
        } else if (
            scrollPosition == 0 &&
            header.classList.contains("scrolled")
        ) {
            header.classList.remove("scrolled");
            console.log("not scrolled");
            header.style.marginBottom = "0";
        }
    }

    // Écoute l'événement de défilement et appelle la fonction de gestion du défilement
    window.addEventListener("scroll", handleScroll);

    // Defilement des textes
    const typed = new Typed(".multiple-text", {
        strings: ["Un stage ? Une alternance ?", "Un emploi ? Une mission ?"],
        typeSpeed: 75,
        backSpeed: 75,
        backDelay: 1200,
        loop: true,
    });
});
