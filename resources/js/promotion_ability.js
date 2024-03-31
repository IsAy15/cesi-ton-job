const csrf = document
    .querySelector('meta[name="csrf_token"]')
    .getAttribute("content");

const popup = document.querySelector("#ability_popup");

const remove_abilities = document.querySelectorAll("a[ability_id]");

const add_abilities = document.querySelectorAll("li[ability_id]");

async function append_ability(id, ability, e) {
    let response = await fetch(`/profile/store/`, {
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
        div.innerHTML = `<p>${ability}</p><a href="#abilities" class="btn-3"><i class="fa-regular fa-circle-xmark"></i></a>`;
        document.querySelector(".ability_container").appendChild(div);
        let btn = div.querySelector("a");
        btn.setAttribute("ability_id", id);
        btn.addEventListener("click", async (e) => {
            delete_ability(e);
        });
    }
}

async function delete_ability(e) {
    if(e.target.tagName != "A"){
        e = e.target.closest('a');
    }else{
        e = e.target;
    }
    let id = e.getAttribute("ability_id");
    let response = await fetch(`/profile/destroy`, {
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
        e.closest("div").remove();
        let li = document.createElement("li");
        li.setAttribute("ability_id", id);
        li.innerHTML = `<p>${e.closest('div').querySelector('p').innerText}</p><a href="#abilities" class="btn-3"><i class="fa-solid fa-plus"></i></a>`;
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
    console.log(remove_ability);
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
