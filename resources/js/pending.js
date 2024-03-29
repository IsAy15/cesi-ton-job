const switchElements = document.querySelectorAll(".switch input");
const csrf = document
    .querySelector('meta[name="csrf_token"]')
    .getAttribute("content");

switchElements.forEach((switchElement) => {
    switchElement.addEventListener("change", async (e) => {
        const userId = e.target.id;
        const response = await fetch(`/profile/update/${userId}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrf,
            },
            body: JSON.stringify({
                status: e.target.checked ? "approved" : "pending",
            }),
        });
        if (response.ok) {
            setTimeout(() => {
                e.target.closest("tr").remove();
            }, 1000);
        }
    });
});
