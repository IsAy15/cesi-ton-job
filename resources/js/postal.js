var input = document.querySelectorAll('[cp]');
var output = document.querySelectorAll('[city]');
if (!input.length) {
    input = output;
}

for (let i = 0; i < input.length; i++) {
    let cpElement = input[i];
    let cp = cpElement.innerText.trim();
    let cityElement = output[i];

    let apiUrl = "https://geo.api.gouv.fr/communes?codePostal=" + encodeURIComponent(cp);

    fetch(apiUrl)
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


