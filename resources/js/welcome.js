import Typed from "typed.js";

document.addEventListener("DOMContentLoaded", function () {
    var header = document.querySelector("header");
    function handleScroll() {
        var scrollPosition = window.scrollY;

        if (
            scrollPosition > 0 &&
            header.offsetTop == Math.round(scrollPosition) &&
            !header.classList.contains("scrolled")
        ) {
            header.classList.add("scrolled");
            header.style.marginBottom = "9rem";
        } else if (
            scrollPosition == 0 &&
            header.classList.contains("scrolled")
        ) {
            header.classList.remove("scrolled");
            header.style.marginBottom = "0";
        }
    }

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
