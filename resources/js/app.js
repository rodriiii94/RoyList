import "./bootstrap";
import showTab from './tabs.js';
import agregarProd from "./agregarProd.js";
import "./buscadorProd.js";

window.showTab = showTab;
agregarProd();
// buscarProducto();

document.addEventListener('DOMContentLoaded', () => {
    showTab('productos');
});