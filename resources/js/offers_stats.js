import Chart from "chart.js/auto";

document.addEventListener("DOMContentLoaded", function () {
    const myChart = document.getElementById("departmentsWithMostOffers");

    var deps = document.querySelectorAll("[dep]");

    var labels = [];
    var values = [];
    for (let dep of deps) {
        labels.push(dep.textContent);
        values.push(dep.closest("li").querySelector("[count]").textContent);
    }

    const data = {
        labels: labels,
        datasets: [
            {
                backgroundColor: [
                    "rgb(54, 162, 235)",
                    "rgb(255, 205, 86)",
                    "rgb(75, 192, 192)",
                    "rgb(153, 102, 255)",
                    "rgb(255, 159, 64)",
                ],
                data: values,
            },
        ],
    };

    const config = {
        type: "doughnut",
        data: data,
        options: {},
    };

    new Chart(myChart, config);
});
