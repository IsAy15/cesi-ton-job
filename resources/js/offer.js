document.addEventListener("DOMContentLoaded", function() {
    const filterButton = document.getElementById("filterButton");
    const filters = document.querySelector(".filters");
    const contractFilter = document.getElementById('contractFilter');
    const durationFilter = document.getElementById('durationFilter');
    const promotionFilter = document.getElementById('promotionFilter');
    const companyFilter = document.getElementById('companyFilter');
    const offerTable = document.getElementById('offerTable').getElementsByTagName('tbody')[0];
    const offers = offerTable.getElementsByTagName('tr');
    const keywordInput = document.getElementById('keywordInput');
    const locationInput = document.getElementById('locationInput');

    function calculateDuration(startingDateStr, endingDateStr) {
        const startingDate = new Date(startingDateStr);
        const endingDate = new Date(endingDateStr);
        const diffTime = Math.abs(endingDate - startingDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

        if (diffDays <= 90) {
            return 'short';
        } else if (diffDays <= 180) { 
            return 'medium';
        } else if (diffDays <= 365) {
            return 'long';
        } else {
            return 'very_long'; 
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

        for (let i = 0; i < offers.length; i++) {
            const offerContract = offers[i].querySelector('[data-type]').getAttribute('data-type').toLowerCase();
            const offerDuration = calculateDuration(offers[i].querySelector('[data-starting-date]').innerText, offers[i].querySelector('[data-ending-date]').innerText);
            const offerPromotionId = offers[i].querySelector('[data-promotion]').getAttribute('data-promotion');
            const offerCompanyId = offers[i].querySelector('[data-company]').getAttribute('data-company');
            const offerTitle = offers[i].querySelector('td:first-child').innerText.toLowerCase();
            const offerPostalCode = offers[i].querySelector('[cp]').innerText.toLowerCase();
            const offerCity = offers[i].querySelector('[city]').innerText.toLowerCase();

            // Vérifier si l'offre passe tous les filtres sélectionnés et la recherche
            const contractPass = selectedContract === 'all' || offerContract === selectedContract;
            const durationPass = selectedDuration === 'all' || offerDuration === selectedDuration;
            const promotionPass = selectedPromotionId === 'all' || offerPromotionId === selectedPromotionId;
            const companyPass = selectedCompanyId === 'all' || offerCompanyId === selectedCompanyId;
            const keywordPass = keyword === '' || offerTitle.includes(keyword);
            const locationPass = location === '' || offerPostalCode.includes(location) || offerCity.includes(location);

            // Afficher ou masquer l'offre en fonction du résultat des filtres et de la recherche
            if (contractPass && durationPass && promotionPass && companyPass && keywordPass && locationPass) {
                offers[i].style.display = '';
            } else {
                offers[i].style.display = 'none';
            }
        }
    }

    // Écouter les changements dans tous les filtres et la recherche
    contractFilter.addEventListener('change', applyFilters);
    durationFilter.addEventListener('change', applyFilters);
    promotionFilter.addEventListener('change', applyFilters);
    companyFilter.addEventListener('change', applyFilters);
    keywordInput.addEventListener('input', applyFilters);
    locationInput.addEventListener('input', applyFilters);

    // Appliquer les filtres une fois que la page est chargée
    applyFilters();

    // Gestion de l'affichage des filtres
    filterButton.addEventListener("click", function() {
        if (filters.style.display === "none") {
            filters.style.display = "block";
        } else {
            filters.style.display = "none";
        }
    });
});
