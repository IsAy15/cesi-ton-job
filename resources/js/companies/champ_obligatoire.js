document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('.form-v');

    form.addEventListener('submit', function(event) {
        const inputs = form.querySelectorAll('input[type="text"], select');

        let allFieldsFilled = true;
        inputs.forEach(function(input) {
            if (input.value.trim() === '') {
                allFieldsFilled = false;
            }
        });

        if (!allFieldsFilled) {
            event.preventDefault();
            alert('Veuillez remplir tous les champs.');
        }
    });
});