import "./bootstrap";
import showTab from "./tabs.js";
import agregarProd from "./agregarProd.js";
import "./buscadorProd.js";
import "./menu.js";

function applyTheme() {
    const theme = localStorage.getItem('theme');
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    }
}

window.showTab = showTab;
agregarProd();

document.addEventListener('DOMContentLoaded', () => {
    applyTheme();
    const toggle = document.getElementById('themeToggle');
    if (toggle) toggle.addEventListener('click', toggleTheme);
    showTab('productos');
});