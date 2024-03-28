document.getElementById('btn-plus').addEventListener('click', function(event) {
    var popup = document.querySelector('.popup');
    if (popup.style.display === 'block') {
        popup.style.display = 'none';
    } else {
        popup.style.display = 'block';
    }
    event.stopPropagation(); 
});

document.addEventListener('click', function(event) {
    var popup = document.querySelector('.popup');
    if (popup.style.display === 'block' && !event.target.closest('.popup')) {
        popup.style.display = 'none';
    }
});