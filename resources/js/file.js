document.addEventListener('DOMContentLoaded', function() {
    var inputs = document.querySelectorAll('.inputfile');
    inputs.forEach(function(input) {
        input.addEventListener('change', function() {
            var fileName = this.files[0].name;
            var fileId = this.id + 'FileName';
            var fileDisplay = document.getElementById(fileId);
            fileDisplay.textContent = fileName;
        });
    });
});