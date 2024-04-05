const searchInput = document.getElementById("searchInput");
const searchResults = document.getElementById("abilities");
const selectedAbilitiesDiv = document.getElementById("selectedAbilities");
const selectedAbilitiesInput = document.getElementById("selectedAbilitiesInput");
const remInPixels = parseFloat(getComputedStyle(document.documentElement).fontSize);
var selectedAbilities = [];

// DOMContentLoaded event
document.addEventListener("DOMContentLoaded", function () {
    selectedAbilities = JSON.parse(selectedAbilitiesInput.value);
    selectedAbilitiesInput.value = "";
    renderSelectedAbilities();
});

function addSelectedAbility(selectedAbility) {
    selectedAbilities.push({
        id: parseInt(selectedAbility.id),
        title: selectedAbility.title,
    });
    removeFromDatalist(selectedAbility.id);
    renderSelectedAbilities();
    updateHiddenInput();
    searchInput.value = "";
}

function removeFromDatalist(id) {
    let option = searchResults.querySelector(`option[ability_id="${id}"]`);
    if (option) {
        searchResults.removeChild(option);
    }
}

function addToDatalist(selectedAbility) {
    let option = document.createElement("option");
    option.setAttribute("ability_id", selectedAbility.id);
    option.value = selectedAbility.title;
    searchResults.appendChild(option);
}

function removeSelectedAbility(id) {
    addToDatalist(selectedAbilities.find((ability) => ability.id === parseInt(id)));
    selectedAbilities = selectedAbilities.filter((ability) => ability.id !== parseInt(id));
    renderSelectedAbilities();
    updateHiddenInput();
}

function renderSelectedAbilities() {
    selectedAbilitiesDiv.innerHTML = selectedAbilities
        .map((ability) => `<p ability_id="${ability.id}">${ability.title}</p>`)
        .join("");
    selectedAbilitiesDiv.querySelectorAll("p").forEach((abilityElement) => {
        let id = abilityElement.getAttribute("ability_id");
        abilityElement.addEventListener("click", () => removeSelectedAbility(id));
    });
}

function updateHiddenInput() {
    selectedAbilitiesInput.value = JSON.stringify(selectedAbilities);
}

searchInput.addEventListener("change", function () {
    let selectedOption = searchResults.querySelector(`option[value="${searchInput.value}"]`);
    if (selectedOption) {
        let selectedID = selectedOption.getAttribute("ability_id");
        let selectedTitle = selectedOption.value;
        addSelectedAbility({
            id: selectedID,
            title: selectedTitle,
        });
    }
});

console.log("Script is running!"); // Check if the script is executed
