// Attend que le document soit prêt
document.addEventListener("DOMContentLoaded", function () {
    // Récupère les éléments HTML nécessaires
    var header = document.querySelector("header");
    var welcomeText = document.querySelector(".welcome");

    // Fonction pour gérer le défilement
    function handleScroll() {
        var scrollPosition = window.scrollY;


        if(scrollPosition > 0 && header.offsetTop == Math.round(scrollPosition) && !header.classList.contains("scrolled")){
            header.classList.add("scrolled");
            console.log("scrolled");
            header.style.marginBottom = "5rem";
        }
        else if(scrollPosition == 0 && header.classList.contains("scrolled")){
            header.classList.remove("scrolled");
            console.log("not scrolled");
            header.style.marginBottom = "0";
        }

    }


        // else{
        //     header.classList.remove("scrolled");
        // }

        // // Si le scroll dépasse le texte de bienvenue
        // if (scrollPosition > (welcomeText.offsetHeight / 1.5) && !header.classList.contains("scrolled")){
        //     // Ajoute la classe "scrolled" au header
        //     header.classList.add("scrolled");
        //     console.log("scrolled");

        //     if(document.body.scrollHeight > window.innerHeight) {
        //         console.log("scrollHeight > innerHeight");
        //         welcomeText.style.display = "block";}
        //     else {
        //         console.log("scrollHeight <= innerHeight");
        //         welcomeText.style.display = "none";
        //     }

        // }else if(scrollPosition <= (welcomeText.offsetHeight / 1.5) ){
        //     // Sinon, retire la classe "scrolled" du header
        //     if(header.classList.contains("scrolled")){
        //         header.classList.remove("scrolled");
            
        //         console.log("not scrolled");
        //     }
        // }

    // Écoute l'événement de défilement et appelle la fonction de gestion du défilement
    window.addEventListener("scroll", handleScroll);
});
