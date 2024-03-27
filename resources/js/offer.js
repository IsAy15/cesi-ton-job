document.addEventListener('DOMContentLoaded', function () {
    var postalCodes = document.querySelectorAll('.code-postal');
    postalCodes.forEach(function(postalCodeElement) {
        var postalCode = postalCodeElement.textContent.trim();
        fetch('https://api-adresse.data.gouv.fr/search/?q=' + postalCode)
            .then(response => response.json())
            .then(data => {
                if (data.features.length > 0) {
                    var city = data.features[0].properties.city;
                    postalCodeElement.nextElementSibling.textContent = city;
                }
            })
            .catch(error => console.error('Erreur lors de la récupération de la ville :', error));
    });

    document.getElementById('searchButton').addEventListener('click', function(event) {
        event.preventDefault();
        var keyword = document.getElementById('keywordInput').value.toUpperCase();
        var location = document.getElementById('locationInput').value.toUpperCase();
        var tableRows = document.querySelectorAll('#offerTable tbody tr');
        tableRows.forEach(function(row) {
            var title = row.querySelector('td:first-child').textContent.toUpperCase();
            var postalCode = row.querySelector('.code-postal').textContent.toUpperCase();
            var city = row.querySelector('.ville').textContent.toUpperCase();
            if (title.includes(keyword) && (postalCode.includes(location) || city.includes(location))) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});
