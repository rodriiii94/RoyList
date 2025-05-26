let productosFiltrados = [];

document.addEventListener("DOMContentLoaded", () => {
    const categoriaSelect = document.getElementById("categoriaSelect");
    const productosContainer = document.getElementById("productosContainer");
    const loader = document.getElementById("loader");
    const buscadorInput = document.getElementById("buscadorInput");
    // Obtenemos el ID de la lista desde una variable global
    const listaId = window.LISTA_ID;

    // Cargar categorías
    fetch("/productos/categorias")
        .then((res) => res.json())
        .then((categorias) => {
            categoriaSelect.innerHTML =
                "<option disabled selected>Selecciona una categoría</option>";
            categorias.forEach((cat) => {
                const opt = document.createElement("option");
                opt.value = cat;
                opt.textContent = cat;
                categoriaSelect.appendChild(opt);
            });
        });

    // Mostrar productos
    function renderizarProductos(productos) {
        productosContainer.innerHTML = productos
            .map(
                (prod) => `
                <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col h-full group">
                    <!-- Imagen del producto -->
                    ${
                        prod.imagen
                            ? `
                    <div class="relative pb-[100%] overflow-hidden bg-gray-50">
                        <img src="${prod.imagen}" alt="${prod.nombre}" 
                            class="absolute inset-0 w-full h-full object-contain p-4 transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-white/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    `
                            : ""
                    }

                    <!-- Contenido -->
                    <div class="p-4 flex flex-col flex-grow">
                        <!-- Nombre y precio -->
                        <div class="flex-grow">
                            <h3 class="text-gray-800 font-medium text-center line-clamp-2 mb-3 leading-tight">${
                                prod.nombre
                            }</h3>
                            
                            ${
                                prod.precio
                                    ? `
                            <div class="mt-3 text-center">
                                <span class="text-xl font-bold text-emerald-600">${
                                    prod.precio
                                } €</span>
                                ${
                                    prod.precioAnterior
                                        ? `
                                <span class="text-sm text-gray-400 line-through ml-2">${prod.precioAnterior} €</span>
                                `
                                        : ""
                                }
                            </div>
                            `
                                    : ""
                            }
                        </div>

                        <!-- Acciones -->
                        <div class="mt-4 space-y-3">
                            ${
                                prod.url
                                    ? `
                            <a href="${prod.url}" target="_blank" 
                            class="flex items-center justify-center text-sm text-blue-600 hover:text-blue-800 font-medium transition-colors gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Ver detalles
                            </a>
                            `
                                    : ""
                            }

                            <button 
                                data-nombre="${prod.nombre}" 
                                data-imagen="${prod.imagen || ""}" 
                                data-precio="${prod.precio || ""}"
                                data-lista-id="${listaId}"
                                class="btn-agregar-producto w-full bg-gradient-to-r from-emerald-500 to-emerald-600 hover:from-emerald-600 hover:to-emerald-700 
                                    text-white font-medium py-2.5 px-4 rounded-lg transition-all duration-200 
                                    hover:shadow-md active:scale-[0.98] flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Añadir
                            </button>
                        </div>
                    </div>
                </div>
                `
            )
            .join("");
    }

    // Evento al seleccionar categoría
    categoriaSelect.addEventListener("change", () => {
        const categoria = categoriaSelect.value;
        productosContainer.innerHTML = "";
        loader.classList.remove("hidden");

        fetch(
            `/productos/por-categoria?categoria=${encodeURIComponent(
                categoria
            )}`
        )
            .then((res) => res.json())
            .then((productos) => {
                loader.classList.add("hidden");
                productosFiltrados = productos; // guardamos todos
                renderizarProductos(productos);
            })
            .catch((error) => {
                console.error("Error al cargar productos:", error);
                loader.classList.add("hidden");
            });
    });

    // Evento al buscar en el input
    buscadorInput.addEventListener("input", () => {
        const texto = buscadorInput.value.toLowerCase();
        const productosFiltradosPorBusqueda = productosFiltrados.filter(
            (prod) => prod.nombre.toLowerCase().includes(texto)
        );
        renderizarProductos(productosFiltradosPorBusqueda);
    });
});
