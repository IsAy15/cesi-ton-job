const selectElement = document.querySelector('#of_company_id');
selectElement.addEventListener('change', (event) => {
if (event.target.value == 'new') {
    window.location.href = '{{ route("companies.create") }}?offer';
}
});