const csrf = document
    .querySelector('meta[name="csrf_token"]')
    .getAttribute("content");
const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("abilities");
const selectedAbilitiesDiv = document.getElementById("selectedAbilities");
const selectedAbilitiesInput = document.getElementById(
    "selectedAbilitiesInput"
);
const remInPixels = parseFloat(
    getComputedStyle(document.documentElement).fontSize
);
var selectedAbilities = [];

// DOMContentLoaded event
document.addEventListener("DOMContentLoaded", function () {
    selectedAbilities = JSON.parse(searchInput.value);
    searchInput.value = "";
    renderselectedAbilities();
    orderDatalistAbilities();
    updateHiddenInput();
});

function addSelectedAbility(selectedAbility) {
    selectedAbilities.push({
        id: parseInt(selectedAbility.id),
        title: selectedAbility.title,
    });
    removeFromDatalist(selectedAbility.id);
    renderselectedAbilities();
    updateHiddenInput();
    searchInput.value = "";
}

function removeFromDatalist(id) {
    let option = searchResults.querySelector(`option[ability_id="${id}"]`);
    if (option) {
        searchResults.removeChild(option);
    }
}

function orderDatalistAbilities() {
    let options = getDatalistOptions();
    options.sort((a, b) => a.value.localeCompare(b.value));
    searchResults.innerHTML = "";
    options.forEach((option) => searchResults.appendChild(option));
}

function addToDatalist(selectedAbility) {
    let option = document.createElement("option");
    option.setAttribute("ability_id", selectedAbility.id);
    option.value = selectedAbility.title;
    searchResults.appendChild(option);
    orderDatalistAbilities();
}

function removeSelectedAbility(id) {
    console.log(selectedAbilities);
    console.log(
        selectedAbilities.find((ability) => ability.id === parseInt(id))
    );
    addToDatalist(
        selectedAbilities.find((ability) => ability.id === parseInt(id))
    );
    selectedAbilities = selectedAbilities.filter(
        (ability) => ability.id !== parseInt(id)
    );
    renderselectedAbilities();
    updateHiddenInput();
}

function renderselectedAbilities() {
    selectedAbilitiesDiv.innerHTML = selectedAbilities
        .map((ability) => `<p ability_id="${ability.id}">${ability.title}</p>`)
        .join("");
    selectedAbilitiesDiv.querySelectorAll("p").forEach((abilityElement) => {
        let id = abilityElement.getAttribute("ability_id");
        abilityElement.addEventListener("click", () =>
            removeSelectedAbility(id)
        );
    });

    // Ajustement de la largeur et de la hauteur de l'input
    adjustInputWidth();
    adjustInputHeight();
}

// Fonction pour récupérer les options de la datalist
function getDatalistOptions() {
    let options = [];
    for (let i = 0; i < searchResults.children.length; i++) {
        options.push(searchResults.children[i]);
    }
    return options;
}

// Fonction pour ajuster la largeur de l'input en fonction de la taille du contenu sélectionné
function adjustInputWidth() {
    let selectedAbilitiesWidth =
        selectedAbilitiesDiv.getBoundingClientRect().width -
        remInPixels / 2 -
        2;
    searchInput.style.width = selectedAbilitiesWidth + "px";
}

// Fonction pour ajuster la hauteur de l'input en fonction de la hauteur de #selectedAbilities
function adjustInputHeight() {
    let selectedAbilitiesHeight =
        selectedAbilitiesDiv.getBoundingClientRect().height;
    searchInput.style.paddingTop =
        remInPixels / 2 + selectedAbilitiesHeight + "px";
}

// Appeler la fonction pour ajuster la largeur lors du chargement de la page
window.addEventListener("load", adjustInputWidth);
// Appeler la fonction pour ajuster la largeur chaque fois que les communes sélectionnées sont mises à jour
window.addEventListener("resize", adjustInputWidth);

// Appeler la fonction pour ajuster la hauteur lors du chargement de la page
window.addEventListener("load", adjustInputHeight);
// Appeler la fonction pour ajuster la hauteur chaque fois que les communes sélectionnées sont mises à jour
window.addEventListener("resize", adjustInputHeight);

function updateHiddenInput() {
    selectedAbilitiesInput.value = JSON.stringify(selectedAbilities);
}

searchInput.addEventListener("change", function () {
    let selectedOption = searchResults.querySelector(
        `option[value="${searchInput.value}"]`
    );
    if (selectedOption) {
        let selectedID = selectedOption.getAttribute("ability_id");
        let selectedTitle = selectedOption.value;
        addSelectedAbility({
            id: selectedID,
            title: selectedTitle,
        });
    }
});
