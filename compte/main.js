const addOverlay = document.querySelector("#add-overlay");
const editOverlay = document.querySelector("#edit-overlay");
const addForm = document.querySelector("#add-form");
const editForm = document.querySelector("#edit-form");

const showForm =  () => {
    addOverlay.classList.add("opacity-50");
    addOverlay.classList.add("z-10");
    addForm.classList.add("scale-100");

}

addOverlay.addEventListener("click", () => {
    addOverlay.classList.remove("opacity-50");
    addOverlay.classList.remove("z-10");
    addForm.classList.remove("scale-100");
})

editOverlay.addEventListener("click", () => {
    editOverlay.classList.remove("opacity-50");
    editOverlay.classList.remove("z-10");
    editForm.classList.remove("scale-100");
    editOverlay.classList.add("opacity-0");
    editOverlay.classList.add("z-0");
    editForm.classList.add("scale-0");
    window.location = "index.php";
})