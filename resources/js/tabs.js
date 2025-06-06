export default function showTab(tab) {
    const productosTab = document.getElementById("tab-content-productos");
    const sugeridosTab = document.getElementById("tab-content-api");
    const btnProductos = document.getElementById("tab-productos");
    const btnSugeridos = document.getElementById("tab-api");

    if (tab === "productos") {
        productosTab.classList.remove("hidden");
        sugeridosTab.classList.add("hidden");

        btnProductos.classList.add(
            "text-green-700",
            "bg-green-100",
            "shadow-inner"
        );
        btnSugeridos.classList.remove(
            "text-green-700",
            "bg-green-100",
            "shadow-inner"
        );
    } else {
        productosTab.classList.add("hidden");
        sugeridosTab.classList.remove("hidden");

        btnSugeridos.classList.add(
            "text-green-700",
            "bg-green-100",
            "shadow-inner"
        );
        btnProductos.classList.remove(
            "text-green-700",
            "bg-green-100",
            "shadow-inner"
        );
    }
}
