const csrf = document
    .querySelector('meta[name="csrf_token"]')
    .getAttribute("content");
const localizationSelect = document.querySelector("#of_localization");
const companySelect = document.querySelector("#of_company_id");

companySelect.addEventListener("change", async function (event) {
    let selectedCompany = companySelect.value;
    let getURL = `/company/${selectedCompany}/localizations`;
    let response = await fetch(getURL, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf,
        },
    });
    if (response.ok) {
        let data = await response.json();
        localizationSelect.innerHTML = "";
        data.forEach((localization) => {
            let option = document.createElement("option");
            option.value = JSON.stringify(localization);
            option.textContent =
                localization.nom + " (" + localization.cp + ")";
            localizationSelect.appendChild(option);
        });
    }
});
