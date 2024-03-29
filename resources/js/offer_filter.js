document.addEventListener('DOMContentLoaded', function() {
    const contractFilter = document.getElementById('contractFilter');
    const durationFilter = document.getElementById('durationFilter');
    const promotionFilter = document.getElementById('promotionFilter');
    const companyFilter = document.getElementById('companyFilter');
    const offerTable = document.getElementById('offerTable').getElementsByTagName('tbody')[0];
    const offers = offerTable.getElementsByTagName('tr');

    // Fonction pour calculer la durée entre deux dates
    function calculateDuration(startingDateStr, endingDateStr) {
        const startingDate = new Date(startingDateStr);
        const endingDate = new Date(endingDateStr);
        const diffTime = Math.abs(endingDate - startingDate);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); // Conversion en jours

        if (diffDays <= 90) {
            return 'short';
        } else if (diffDays <= 180) { 
            return 'medium';
        } else if (diffDays <= 365) {
            return 'long';
        } else {
            return 'very-long'; 
        }
    }

    // Fonction pour appliquer tous les filtres sélectionnés
    function applyFilters() {
        const selectedContract = contractFilter.value.toLowerCase();
        const selectedDuration = durationFilter.value;
        const selectedPromotionId = promotionFilter.value;
        const selectedCompanyId = companyFilter.value;

        for (let i = 0; i < offers.length; i++) {
            const offerContract = offers[i].querySelector('[data-type]').getAttribute('data-type').toLowerCase();
            const offerDuration = calculateDuration(offers[i].querySelector('[data-starting-date]').innerText, offers[i].querySelector('[data-ending-date]').innerText);
            const offerPromotionId = offers[i].querySelector('[data-promotion]').getAttribute('data-promotion');
            const offerCompanyId = offers[i].querySelector('[data-company]').getAttribute('data-company');

            // Vérifier si l'offre passe tous les filtres sélectionnés
            const contractPass = selectedContract === 'all' || offerContract === selectedContract;
            const durationPass = selectedDuration === 'all' || offerDuration === selectedDuration;
            const promotionPass = selectedPromotionId === 'all' || offerPromotionId === selectedPromotionId;
            const companyPass = selectedCompanyId === 'all' || offerCompanyId === selectedCompanyId;

            // Afficher ou masquer l'offre en fonction du résultat des filtres
            if (contractPass && durationPass && promotionPass && companyPass) {
                offers[i].style.display = '';
            } else {
                offers[i].style.display = 'none';
            }
        }
    }

    // Écouter les changements dans tous les filtres
    contractFilter.addEventListener('change', applyFilters);
    durationFilter.addEventListener('change', applyFilters);
    promotionFilter.addEventListener('change', applyFilters);
    companyFilter.addEventListener('change', applyFilters);
});
