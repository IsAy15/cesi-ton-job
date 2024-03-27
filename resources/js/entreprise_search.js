function filterCompanies() {
    var input, filter, companies, company, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    companies = document.getElementsByClassName("company");
    for (i = 0; i < companies.length; i++) {
        company = companies[i].getElementsByClassName("infos")[0];
        txtValue = company.textContent || company.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            companies[i].style.display = "";
        } else {
            companies[i].style.display = "none"; 
        }
    }
}

document.getElementById("searchInput").addEventListener("keyup", filterCompanies);