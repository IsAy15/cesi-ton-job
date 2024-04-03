document.addEventListener('DOMContentLoaded', function() {
    var roleSelect = document.getElementById('role');
    var form = document.querySelector('.form-v');
    var levelCheckboxes = document.querySelectorAll('input[name="levels[]"]');
    
    // Fonction pour désactiver tous les autres checkboxes sauf celui sélectionné
    function disableOtherCheckboxes(checkbox) {
        levelCheckboxes.forEach(function(otherCheckbox) {
            if (otherCheckbox !== checkbox) {
                otherCheckbox.checked = false;
            }
        });
    }

    // Gérer le changement de sélection du rôle
    roleSelect.addEventListener('change', function() {
        if (roleSelect.value === 'user') {
            // Activer la gestion des clics pour les checkboxes si le rôle est "user"
            levelCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function() {
                    disableOtherCheckboxes(checkbox);
                });
            });
        } else {
            // Désactiver la gestion des clics pour les checkboxes si le rôle est autre que "user"
            levelCheckboxes.forEach(function(checkbox) {
                checkbox.removeEventListener('click', null);
            });
        }
    });

    // Désactiver tous les autres checkboxes si un seul est sélectionné
    levelCheckboxes.forEach(function(checkbox) {
        checkbox.addEventListener('click', function() {
            if (roleSelect.value === 'user') {
                disableOtherCheckboxes(checkbox);
            }
        });
    });

    // Valider le formulaire avant soumission
    form.addEventListener('submit', function(event) {
        // Récupérer tous les champs du formulaire
        const inputs = form.querySelectorAll('input[type="text"], input[type="email"], select');

        // Vérifier si tous les champs sont remplis
        let allFieldsFilled = true;
        inputs.forEach(function(input) {
            if (input.value.trim() === '') {
                allFieldsFilled = false;
            }
        });

        // Vérifier si au moins une case à cocher est cochée
        let atLeastOneCheckboxChecked = false;
        levelCheckboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                atLeastOneCheckboxChecked = true;
            }
        });

        // Si un champ est vide ou aucune case à cocher n'est cochée, empêcher la soumission du formulaire
        if (!allFieldsFilled || !atLeastOneCheckboxChecked) {
            event.preventDefault();
            alert('Veuillez remplir tous les champs et sélectionner au moins un niveau.');
        }
    });
});