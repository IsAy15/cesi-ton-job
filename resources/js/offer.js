document.addEventListener("DOMContentLoaded", async function () {
    const filterButton = document.getElementById("filterButton");
    const filters = document.querySelector(".filters");
    const contractFilter = document.getElementById("contractFilter");
    const durationFilter = document.getElementById("durationFilter");
    const promotionFilter = document.getElementById("promotionFilter");
    const companyFilter = document.getElementById("companyFilter");
    const offerTable = document.querySelector(".offers-container");
    const offers = offerTable.querySelectorAll("[offer]");
    const keywordInput = document.getElementById("keywordInput");
    const locationInput = document.getElementById("locationInput");

    function calculateDuration(duration) {
        if (duration <= 90) {
            return "short";
        } else if (duration <= 180) {
            return "medium";
        } else if (duration <= 365) {
            return "long";
        } else {
            return "very_long";
        }
    }

    // Fonction pour appliquer tous les filtres sélectionnés
    function applyFilters() {
        const selectedContract = contractFilter.value.toLowerCase();
        const selectedDuration = durationFilter.value;
        const selectedPromotionId = promotionFilter.value;
        const selectedCompanyId = companyFilter.value;
        const keyword = keywordInput.value.toLowerCase();
        const location = locationInput.value.toLowerCase();

        for (let offer of offers) {
            let offerPromotion = offer
                .querySelector("[promo]")
                .getAttribute("promo");
            let offerCompany = offer
                .querySelector("[company]")
                .getAttribute("company");
            let offerContract = offer
                .querySelector("[contract]")
                .textContent.toLowerCase();
            let offerDuration = calculateDuration(
                parseInt(
                    offer.querySelector("[duration]").getAttribute("duration")
                )
            );
            let offerTitle = offer
                .querySelector("[title]")
                .textContent.toLowerCase();
            let offerDepartement = offer
                .querySelector("[dep]")
                .getAttribute("dep");

            let contractPass =
                selectedContract === "all" ||
                offerContract === selectedContract;
            let durationPass =
                selectedDuration === "all" ||
                offerDuration === selectedDuration;
            let promotionPass =
                selectedPromotionId === "all" ||
                offerPromotion === selectedPromotionId;
            let companyPass =
                selectedCompanyId === "all" ||
                offerCompany === selectedCompanyId;
            let keywordPass = keyword === "" || offerTitle.includes(keyword);
            let locationPass =
                location === "" || offerDepartement.includes(location);
            if (
                contractPass &&
                durationPass &&
                promotionPass &&
                companyPass &&
                keywordPass &&
                locationPass
            ) {
                offer.style.display = "";
            } else {
                offer.style.display = "none";
            }
        }
    }

    // Écouter les changements dans tous les filtres et la recherche
    contractFilter.addEventListener("change", applyFilters);
    durationFilter.addEventListener("change", applyFilters);
    promotionFilter.addEventListener("change", applyFilters);
    companyFilter.addEventListener("change", applyFilters);
    keywordInput.addEventListener("input", applyFilters);
    locationInput.addEventListener("input", applyFilters);

    // Appliquer les filtres une fois que la page est chargée
    applyFilters();

    // Gestion de l'affichage des filtres
    filterButton.addEventListener("click", function () {
        if (filters.style.display === "none") {
            filters.style.display = "block";
        } else {
            filters.style.display = "none";
        }
    });

    const searchResults = document.getElementById("communes");

    fetch("https://geo.api.gouv.fr/departements")
        .then((response) => response.json())
        .then((data) => {
            for (let dep of data) {
                var option = document.createElement("option");
                option.value = dep.code;
                option.textContent = dep.nom;
                searchResults.appendChild(option);
            }
        })
        .catch((error) => {
            console.error("Erreur:", error);
        });
});
