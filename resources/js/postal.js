var codeposInput = document.getElementById("of_codepos");
var localizationInput = document.getElementById("of_localization");

codeposInput.addEventListener("input", function () {
    var codepos = codeposInput.value.trim();

    if (codepos === "") {
        localizationInput.value = "";
        return;
    }

    var apiUrl = "https://geo.api.gouv.fr/communes?codePostal=" + codepos;

    fetch(apiUrl)
        .then((response) => response.json())
        .then((data) => {
            localizationInput.value = data.nom;
        })
        .catch((error) => {
            console.error("Erreur:", error);
            localizationInput.value = "";
        });
});

codeposInput.addEventListener("input", function () {
    codeposInput.value = codeposInput.value.replace(/\D/g, "");
});
