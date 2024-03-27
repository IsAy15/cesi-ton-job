document.addEventListener('DOMContentLoaded', function () {

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
