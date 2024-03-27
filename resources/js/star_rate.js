let companiesRate = document.querySelectorAll("[note]");

for (let stars of companiesRate) {
    let note = stars.getAttribute("note");
    let rate = document.querySelector("#rating");

    stars.classList.add("ratings");

    for (let i = 5; i > 0; i--) {
        let star = document.createElement("span");
        star.dataset.rating = i;
        star.innerHTML = "&#9733;";
        if(stars.classList.contains("active")) {
            star.addEventListener("click", function () {
                let children = star.parentElement.children;
                for (let child of children) {
                    if (child.dataset.rating != this.dataset.rating) {
                        child.removeAttribute("data-clicked");
                    }
                }

                this.dataset.clicked = true;
                rate.value = this.dataset.rating;
            });
        }
        if (star.dataset.rating == Math.floor(note)) {
            star.dataset.clicked = true;
        }
        if (star.dataset.rating == Math.floor(note) + 1) {
            star.classList.add("half");
            star.style.setProperty(
            "--vnote",
            Math.round((note - Math.floor(note)) * 100) + "%"
            );
        }

        stars.appendChild(star);
    }
}