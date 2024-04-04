import Chart from "chart.js/auto";
const apiUrl = "https://geo.api.gouv.fr/";

var depsLabels = [];
var depsValues = [];

var abilitiesLabels = [];
var abilitiesValues = [];

document.addEventListener("DOMContentLoaded", async function () {
    const departmentsWithMostCompanies = document.querySelector(
        "#departmentsWithMostOffers > canvas"
    );

    const topAbilities = document.querySelector("#topAbilities > canvas");

    const depsArray = JSON.parse(
        departmentsWithMostCompanies.getAttribute("data")
    );

    const abilitiesArray = JSON.parse(topAbilities.getAttribute("data"));

    // Utilisation de Promise.all pour attendre que toutes les requêtes asynchrones soient terminées
    await Promise.all(
        depsArray.map(async (dep) => {
            depsValues.push(dep.offers_count);
            const response = await fetch(apiUrl + "departements/" + dep.dep);
            const data = await response.json();
            depsLabels.push(data.nom);
        }),
        abilitiesArray.map((ability) => {
            abilitiesValues.push(ability.offers_count);
            abilitiesLabels.push(ability.title);
        })
    );

    const depsData = {
        labels: depsLabels,
        datasets: [
            {
                backgroundColor: [
                    "rgb(54, 162, 235)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                    "rgb(153, 102, 255)",
                    "rgb(255, 159, 64)",
                ],
                data: depsValues,
                hoverOffset: 4,
                label: "Nombre d'offres",
            },
        ],
    };

    const depsConfig = {
        type: "doughnut",
        data: depsData,
        options: {
            animation: {
                animateScale: true,
            },
        },
    };

    const abilitiesData = {
        labels: abilitiesLabels,
        datasets: [
            {
                backgroundColor: [
                    "rgb(54, 162, 235)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                ],
                data: abilitiesValues,
                hoverOffset: 4,
                label: "Nombre d'offres",
            },
        ],
    };

    const abilitiesConfig = {
        type: "doughnut",
        data: abilitiesData,
        options: {
            animation: {
                animateScale: true,
            },
        },
    };

    new Chart(departmentsWithMostCompanies, depsConfig);
    new Chart(topAbilities, abilitiesConfig);
});
