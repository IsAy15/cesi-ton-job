document.addEventListener('DOMContentLoaded', function() {
    const paginationContainer = document.getElementById('paginationContainer');
    const paginationLinks = paginationContainer.querySelectorAll('a');
    const currentPage = parseInt("{{ $currentPage }}");
    const totalPages = parseInt("{{ $totalPages }}");

    if (currentPage > 1) {
        const previousLink = document.createElement('li');
        previousLink.innerHTML = `<a href="{{ route('offers.index') }}?page=${currentPage - 1}">Précédent</a>`;
        paginationContainer.querySelector('ul').prepend(previousLink);
    }

    if (currentPage < totalPages) {
        const nextLink = document.createElement('li');
        nextLink.innerHTML = `<a href="{{ route('offers.index') }}?page=${currentPage + 1}">Suivant</a>`;
        paginationContainer.querySelector('ul').append(nextLink);
    }

    if (totalPages > 5) {
        if (currentPage > 3) {
            const firstLink = document.createElement('li');
            firstLink.innerHTML = `<a href="{{ route('offers.index') }}?page=1">1</a>`;
            paginationContainer.querySelector('ul').prepend(firstLink);
        }

        if (currentPage > 4) {
            const previousDots = document.createElement('li');
            previousDots.innerHTML = `<a href="#">...</a>`;
            paginationContainer.querySelector('ul').prepend(previousDots);
        }

        if (currentPage < totalPages - 3) {
            const nextDots = document.createElement('li');
            nextDots.innerHTML = `<a href="#">...</a>`;
            paginationContainer.querySelector('ul').append(nextDots);
        }

        if (currentPage < totalPages - 2) {
            const lastLink = document.createElement('li');
            lastLink.innerHTML = `<a href="{{ route('offers.index') }}?page=${totalPages}">${totalPages}</a>`;
            paginationContainer.querySelector('ul').append(lastLink);
        }
    }
});
