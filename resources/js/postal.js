// postal.js

// Script pour récupérer la localisation en fonction du code postal
var codeposInput = document.getElementById('of_codepos');
var localizationInput = document.getElementById('of_localization');

codeposInput.addEventListener('input', function() {
    var codepos = codeposInput.value.trim();

    if (codepos === '') {
        localizationInput.value = '';
        return;
    }

    var apiUrl = 'https://api-adresse.data.gouv.fr/search/?q=' + codepos;

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            if (data && data.features && data.features.length > 0 && data.features[0].properties.city) {
                localizationInput.value = data.features[0].properties.city;
            } else {
                localizationInput.value = '';
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
});

// Script pour filtrer les caractères non numériques dans le champ du code postal
codeposInput.addEventListener('input', function() {
    // Filtrer les caractères non numériques
    codeposInput.value = codeposInput.value.replace(/\D/g, '');
});
