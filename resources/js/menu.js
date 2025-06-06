document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.getElementById("menuToggle");
    const dropdownMenu = document.getElementById("dropdownMenu");
    if (menuToggle && dropdownMenu) {
        menuToggle.addEventListener("click", function () {
            dropdownMenu.classList.toggle("hidden");
        });
        // Cerrar el menú al hacer clic fuera de él
        document.addEventListener("click", function (event) {
            if (
                !menuToggle.contains(event.target) &&
                !dropdownMenu.contains(event.target)
            ) {
                dropdownMenu.classList.add("hidden");
            }
        });
    }
});
