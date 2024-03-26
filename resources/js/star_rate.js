let stars = document.querySelectorAll(".ratings span");
let products = document.querySelectorAll(".ratings");
let rate = document.querySelector("#rating");

for (let star of stars) {
    star.addEventListener("click", function () {
        let children = star.parentElement.children;
        for (let child of children) {
            if (child.dataset.rating != this.dataset.rating) {
                child.removeAttribute("data-clicked");
            }
        }

        this.setAttribute("data-clicked", "true");
        rate.value = this.dataset.rating;
    });
}
