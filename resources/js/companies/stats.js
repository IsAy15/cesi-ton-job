import Chart from "chart.js/auto";
const apiUrl = "https://geo.api.gouv.fr/";

var companiesLabels = [];
var companiesValues = [];

var appsLabels = [];
var appsValues = [];

var depsLabels = [];
var depsValues = [];

var sectorsLabels = [];
var sectorsValues = [];

document.addEventListener("DOMContentLoaded", async function () {
    const companiesWithMostOffers = document.querySelector(
        "#companiesWithMostOffers > canvas"
    );

    const companiesWithMostApplications = document.querySelector(
        "#companiesWithMostApplications > canvas"
    );

    const departmentsWithMostCompanies = document.querySelector(
        "#departmentsWithMostCompanies > canvas"
    );

    const sectorsWithMostCompanies = document.querySelector(
        "#sectorsWithMostCompanies > canvas"
    );

    const companiesArray = JSON.parse(
        companiesWithMostOffers.getAttribute("data")
    );

    const appsArray = JSON.parse(
        companiesWithMostApplications.getAttribute("data")
    );

    const sectorsArray = JSON.parse(
        sectorsWithMostCompanies.getAttribute("data")
    );

    const depsArray = JSON.parse(
        departmentsWithMostCompanies.getAttribute("data")
    );

    // Utilisation de Promise.all pour attendre que toutes les requêtes asynchrones soient terminées
    await Promise.all(
        depsArray.map(async (dep) => {
            depsValues.push(dep.companies_count);
            const response = await fetch(apiUrl + "departements/" + dep.dep);
            const data = await response.json();
            depsLabels.push(data.nom);
        }),
        companiesArray.map((company) => {
            companiesValues.push(company.offers_count);
            companiesLabels.push(company.name);
        }),
        appsArray.map((app) => {
            appsValues.push(app.offers_sum_applies_count);
            appsLabels.push(app.name);
        }),
        sectorsArray.map((sector) => {
            sectorsValues.push(sector.sector_count);
            sectorsLabels.push(sector.sector);
        })
    );

    const companiesData = {
        labels: companiesLabels,
        datasets: [
            {
                backgroundColor: [
                    "rgb(54, 162, 235)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                    "rgb(153, 102, 255)",
                    "rgb(255, 159, 64)",
                ],
                data: companiesValues,
                hoverOffset: 4,
                label: "Nombre d'offres",
            },
        ],
    };

    const companiesConfig = {
        type: "doughnut",
        data: companiesData,
        options: {
            animation: {
                animateScale: true,
            },
        },
    };

    const appsData = {
        labels: appsLabels,
        datasets: [
            {
                backgroundColor: [
                    "rgb(54, 162, 235)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                    "rgb(153, 102, 255)",
                    "rgb(255, 159, 64)",
                ],
                data: appsValues,
                hoverOffset: 4,
                label: "Nombre d'applications",
            },
        ],
    };

    const appsConfig = {
        type: "doughnut",
        data: appsData,
        options: {
            animation: {
                animateScale: true,
            },
        },
    };

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
                label: "Nombre d'entreprises",
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

    const sectorsData = {
        labels: sectorsLabels,
        datasets: [
            {
                backgroundColor: [
                    "rgb(54, 162, 235)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                    "rgb(153, 102, 255)",
                    "rgb(255, 159, 64)",
                ],
                data: sectorsValues,
                hoverOffset: 4,
            },
        ],
    };

    const sectorsConfig = {
        type: "doughnut",
        data: sectorsData,
        options: {
            animation: {
                animateScale: true,
            },
        },
    };

    new Chart(companiesWithMostOffers, companiesConfig);
    new Chart(companiesWithMostApplications, appsConfig);
    new Chart(departmentsWithMostCompanies, depsConfig);
    new Chart(sectorsWithMostCompanies, sectorsConfig);
});
