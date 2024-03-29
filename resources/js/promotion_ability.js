const csrf = document
    .querySelector('meta[name="csrf_token"]')
    .getAttribute("content");

const popup = document.querySelector("#ability_popup");

const remove_abilities = document.querySelectorAll(".fa-circle-xmark");

const add_abilities = document.querySelectorAll("li[ability_id]");

async function append_ability(id, ability, e) {
    const response = await fetch(`/profile/store/`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf,
        },
        body: JSON.stringify({
            abilities: id,
        }),
    });
    if (response.ok) {
        e.target.closest("li").remove();
        let div = document.createElement("div");
        div.classList.add("liste-h", "elements");
        div.innerHTML = `<p>${ability}</p><a href="#admin" class="btn-3"><i class="fa-regular fa-circle-xmark"></i></a>`;
        document.querySelector(".ability_container").appendChild(div);
        let btn = div.querySelector("a");
        btn.setAttribute("ability_id", id);
        btn.addEventListener("click", async (e) => {
            delete_ability(e);
        });
    }
}

async function delete_ability(e) {
    const id = e.target.getAttribute("ability_id");
    const response = await fetch(`/profile/destroy`, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf,
        },
        body: JSON.stringify({
            ability: id,
        }),
    });
    if (response.ok) {
        e.target.closest("div").remove();
        let li = document.createElement("li");
        li.setAttribute("ability_id", id);
        li.innerHTML = `<p>${e.target.previousElementSibling.innerText}</p><a href="#admin" class="btn-1 btn-2 fa-solid fa-plus"></a>`;
        document.querySelector("#ability_popup > ul").appendChild(li);
        let btn = li.querySelector("a");
        let ability = li.querySelector("p").innerText;
        btn.addEventListener("click", async (e) => {
            append_ability(id, ability, e);
        });
    }
}

document.getElementById("btn-plus").addEventListener("click", async (e) => {
    setTimeout(() => {
        popup.open = !popup.open;
    }, 100);
});

document.addEventListener("click", function (event) {
    if (popup.open) {
        popup.open = false;
    }
});

for (let remove_ability of remove_abilities) {
    remove_ability.addEventListener("click", async (e) => {
        delete_ability(e);
    });
}

for (let add_ability of add_abilities) {
    let id = add_ability.getAttribute("ability_id");
    let btn = add_ability.querySelector("a");
    let ability = add_ability.querySelector("p").innerText;
    btn.addEventListener("click", async (e) => {
        append_ability(id, ability, e);
    });
}
