document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.form-v');

    form.addEventListener('submit', function(event) {
        // Récupérer tous les champs du formulaire
        const inputs = form.querySelectorAll('input[type="text"]');

        // Vérifier si tous les champs sont remplis
        let allFieldsFilled = true;
        inputs.forEach(function(input) {
            if (input.value.trim() === '') {
                allFieldsFilled = false;
            }
        });

        // Si un champ est vide, empêcher la soumission du formulaire
        if (!allFieldsFilled) {
            event.preventDefault();
            alert('Veuillez remplir tous les champs.');
        }
    });
});