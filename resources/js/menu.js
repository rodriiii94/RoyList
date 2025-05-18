document.addEventListener("DOMContentLoaded", function () {
    const toggle = document.getElementById("menuToggle");
    const menu = document.getElementById("dropdownMenu");

    toggle.addEventListener("click", function () {
        menu.classList.toggle("hidden");
    });

    // Ocultar el menú si se hace clic fuera
    document.addEventListener("click", function (e) {
        if (!toggle.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add("hidden");
        }
    });
});
