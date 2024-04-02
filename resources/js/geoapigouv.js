var departements = document.querySelectorAll("[dep]");
var apiUrl = "https://geo.api.gouv.fr/";

for (let dep of departements) {
    var getURL =
        apiUrl + "departements/" + encodeURIComponent(dep.getAttribute("dep"));
    fetch(getURL)
        .then((response) => response.json())
        .then((data) => {
            dep.innerText = data.nom;
        })
        .catch((error) => {
            console.error("Erreur:", error);
        });
}

var input = document.querySelectorAll("[cp]");
var output = document.querySelectorAll("[city]");
if (!input.length) {
    input = output;
}

for (let i = 0; i < input.length; i++) {
    let cpElement = input[i];
    let cp = cpElement.innerText.trim().replace(/[^0-9]/g, ''); // Extract only digits
    let cityElement = output[i];

    let getURL = apiUrl + "communes?codePostal=" + encodeURIComponent(cp);

    fetch(getURL)
        .then((response) => response.json())
        .then((data) => {
            if (data.length > 0) {
                cityElement.innerText = data[0].nom;
            } else {
                cityElement.innerText = "City Not Found";
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            cityElement.innerText = "";
        });
}