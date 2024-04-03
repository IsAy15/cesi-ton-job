document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addAbilityForm');

    // Ajouter un écouteur d'événement sur la soumission du formulaire
    form.addEventListener('submit', function(event) {
      // Vérifier si tous les champs sont remplis
      const inputs = form.querySelectorAll('input[type="text"]');
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