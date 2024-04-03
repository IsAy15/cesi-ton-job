document.addEventListener('DOMContentLoaded', function() {
    var roleSelect = document.getElementById('role');
    var levelCheckboxes = document.querySelectorAll('input[name="levels[]"]');
    
    roleSelect.addEventListener('change', function() {
        if (roleSelect.value === 'user') {
            levelCheckboxes.forEach(function(checkbox) {
                checkbox.addEventListener('click', function() {
                    // Désactiver tous les autres checkboxes
                    levelCheckboxes.forEach(function(otherCheckbox) {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.checked = false;
                        }
                    });
                });
            });
        } else {
            levelCheckboxes.forEach(function(checkbox) {
                checkbox.removeEventListener('click', null);
            });
        }
    });

    document.getElementById('password').addEventListener('input', function() {
        if (this.value.length < 6) {
            this.setCustomValidity('Le mot de passe doit contenir au moins 6 caractères');
        } else {
            this.setCustomValidity('');
        }
    });

    document.getElementById('user-form').addEventListener('submit', function(event) {
        var role = document.getElementById('role').value;
        var promotion = document.getElementById('promotion').value;

        if (role === 'admin' && promotion !== '') {
            event.preventDefault();
            alert('Un admin ne peut pas avoir de promotion');
        }

        if (role !== 'admin' && promotion === '') {
            event.preventDefault();
            alert('Veuillez sélectionner une promotion');
        }
    });
});
