const apiUrl = "https://geo.api.gouv.fr/";
const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("communes");
const selectedCommunesDiv = document.getElementById("selectedCommunes");
const selectedCommunesInput = document.getElementById("selectedCommunesInput");
const remInPixels = parseFloat(getComputedStyle(document.documentElement).fontSize);
var selectedCommunes = [];

// DOMContentLoaded event
document.addEventListener("DOMContentLoaded", function() {
    if(searchInput.value){
        selectedCommunes = JSON.parse(searchInput.value);
        selectedCommunes.forEach(selectedCommune => {
            removeSelectedCommune(selectedCommune.cp, selectedCommune.code);
            addSelectedCommune(selectedCommune);
        });
    }
});

function addSelectedCommune(selectedCommune) {
    let isDuplicate = selectedCommunes.some(commune => commune.nom === selectedCommune.nom && commune.code === selectedCommune.code && commune.cp === selectedCommune.cp);

    if (!isDuplicate) {
        selectedCommunes.push({
            nom: selectedCommune.nom,
            code: selectedCommune.code,
            cp: selectedCommune.cp,
            dep: selectedCommune.dep
        });
        renderSelectedCommunes();
        updateHiddenInput(); // Mettre à jour le champ de formulaire caché
    }
    searchInput.value = "";
}

function removeSelectedCommune(cp, code) {
    selectedCommunes = selectedCommunes.filter(commune => !(commune.cp === cp && commune.code === code));
    renderSelectedCommunes();
    updateHiddenInput(); // Mettre à jour le champ de formulaire caché
}

function renderSelectedCommunes() {
    selectedCommunesDiv.innerHTML = selectedCommunes.map(commune => `<p data-id="${commune.cp}/${commune.code}">${commune.nom} (${commune.cp})</p>`).join("");
    selectedCommunesDiv.querySelectorAll("p").forEach(communeElement => {
        const [cp, code] = communeElement.dataset.id.split("/");
        communeElement.addEventListener("click", () => removeSelectedCommune(cp, code));
    });

    // Ajustement de la largeur et de la hauteur de l'input
    adjustInputWidth();
    adjustInputHeight();
}

// Fonction pour récupérer les options de la datalist
function getDatalistOptions() {
    const options = [];
    for (let i = 0; i < searchResults.children.length; i++) {
        options.push(searchResults.children[i]);
    }
    return options;
}

// Fonction pour ajuster la largeur de l'input en fonction de la taille du contenu sélectionné
function adjustInputWidth() {
    const selectedCommunesWidth = selectedCommunesDiv.getBoundingClientRect().width - (remInPixels /2) - 2;
    searchInput.style.width = selectedCommunesWidth + 'px';
}

// Fonction pour ajuster la hauteur de l'input en fonction de la hauteur de #selectedCommunes
function adjustInputHeight() {
    const selectedCommunesHeight = selectedCommunesDiv.getBoundingClientRect().height;
    searchInput.style.paddingTop = (remInPixels/2) + selectedCommunesHeight + 'px';
}

// Appeler la fonction pour ajuster la largeur lors du chargement de la page
window.addEventListener('load', adjustInputWidth);
// Appeler la fonction pour ajuster la largeur chaque fois que les communes sélectionnées sont mises à jour
window.addEventListener('resize', adjustInputWidth);

// Appeler la fonction pour ajuster la hauteur lors du chargement de la page
window.addEventListener('load', adjustInputHeight);
// Appeler la fonction pour ajuster la hauteur chaque fois que les communes sélectionnées sont mises à jour
window.addEventListener('resize', adjustInputHeight);

// Initialisation des options de la datalist
let datalistOptions = [];

// Fonction pour mettre à jour le champ de formulaire caché avec les informations de selectedCommunes
function updateHiddenInput() {
    selectedCommunesInput.value = JSON.stringify(selectedCommunes);
}

searchInput.addEventListener("input", function () {
    const inputText = this.value.trim();
    const cpRegex = /^[0-9]+$/;
    const nomRegex = /^[a-zA-ZÀ-ÿ\s\-]+$/;
    let getURL = "";

    if (cpRegex.test(inputText)) {
        if (inputText.length < 2 || inputText.length > 5) return;
        else if (inputText.length == 5) {
            getURL =
                apiUrl + "communes?codePostal=" + encodeURIComponent(inputText);
        } else {
            getURL =
                apiUrl +
                "departements/" +
                encodeURIComponent(inputText.substring(0, 2)) +
                "/communes";
        }
    } else if (nomRegex.test(inputText)) {
        getURL = apiUrl + "communes?nom=" + encodeURIComponent(inputText);
    } else {
        searchResults.innerHTML = "";
        return;
    }

    fetch(getURL)
        .then((response) => response.json())
        .then((data) => {
            searchResults.innerHTML = "";
            data.forEach((commune) => {
                commune.codesPostaux.forEach((cp) => {
                    let option = document.createElement("option");
                    option.value = `${commune.nom} (${cp})`; // Afficher le nom de la commune avec son code postal
                    option.textContent = commune.nom;
                    option.setAttribute("cp", cp); // Ajouter attribut pour le code postal
                    option.setAttribute("code", commune.code); // Ajouter attribut pour le code de la commune
                    option.setAttribute("dep", commune.codeDepartement); // Ajouter attribut pour le code du département
                    searchResults.appendChild(option);
                });
            });

            // Mettre à jour les options de la datalist
            datalistOptions = getDatalistOptions();
        });
});

searchInput.addEventListener("change", function (event) {
    const selectedOption = datalistOptions.find(option => option.value.toLowerCase() === this.value.toLowerCase());
    if (selectedOption) {
        const selectedCP = selectedOption.getAttribute("cp");
        const selectedCommuneCode = selectedOption.getAttribute("code");
        const selectedDep = selectedOption.getAttribute("dep");
        addSelectedCommune({
            nom: selectedOption.textContent,
            code: selectedCommuneCode,
            cp: selectedCP,
            dep: selectedDep
        });
    }
});
