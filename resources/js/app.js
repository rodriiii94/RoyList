import "./bootstrap";
import showTab from "./tabs.js";
import agregarProd from "./agregarProd.js";
import "./buscadorProd.js";
import "./menu.js";

window.showTab = showTab;
agregarProd();

document.addEventListener('DOMContentLoaded', () => {
    showTab('productos');
});