var ligne = document.querySelectorAll("[dep]");
var apiUrl = "https://geo.api.gouv.fr/departements/";

for (let dep of ligne) {
    var getURL = apiUrl + dep.getAttribute("dep");
    fetch(getURL)
        .then((response) => response.json())
        .then((data) => {
            dep.innerText = data.nom;
        })
        .catch((error) => {
            console.error("Erreur:", error);
        });
}
