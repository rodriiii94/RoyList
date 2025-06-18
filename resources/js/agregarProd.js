export default function agregarProd() {
    document.addEventListener("DOMContentLoaded", () => {
        let productoSeleccionado = null;

        document.body.addEventListener("click", function (e) {
            if (e.target.classList.contains("btn-agregar-producto")) {
                productoSeleccionado = {
                    nombre_producto: e.target.dataset.nombre,
                    imagen: e.target.dataset.imagen,
                    precio: e.target.dataset.precio,
                    lista_compra_id: e.target.dataset.listaId,
                };
                
                document.getElementById("notaInput").value = "";
                document.getElementById("cantidadInput").value = 1;
                document.getElementById("modalNota").classList.remove("hidden");
            }
        });

        const btnPersonalizado = document.getElementById("btn-personalizado");
        if (btnPersonalizado) {
            btnPersonalizado.addEventListener("click", () => {
                document
                    .getElementById("modalPersonalizado")
                    .classList.remove("hidden");
            });
        }
        
        const cancelarNotaBtn = document.getElementById("cancelarNota");
        if (cancelarNotaBtn) {
            cancelarNotaBtn.addEventListener("click", () => {
                document.getElementById("modalNota").classList.add("hidden");
            });
        }

        const cancelarPersonalizadoBtn = document.getElementById(
            "cancelarPersonalizado"
        );
        if (cancelarPersonalizadoBtn) {
            cancelarPersonalizadoBtn.addEventListener("click", () => {
                document
                    .getElementById("modalPersonalizado")
                    .classList.add("hidden");
            });
        }
        
        document.getElementById("guardarNota").addEventListener("click", () => {
            const nota = document.getElementById("notaInput").value;
            const cantidad = document.getElementById("cantidadInput").value;
            
            fetch("/producto/guardar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content,
                },
                body: JSON.stringify({
                    ...productoSeleccionado,
                    notas: nota,
                    cantidad: cantidad,
                }),
            })
            .then((res) => res.json())
            .then((data) => {
                document
                .getElementById("modalNota")
                .classList.add("hidden");
            })
            .catch((err) => {
                console.log("Este es el producto:", productoSeleccionado);
                console.error("Error al guardar:", err);
            });
        });

        const guardarPersonalizadoBtn = document.getElementById(
            "guardarPersonalizado"
        );
        if (guardarPersonalizadoBtn) {
            guardarPersonalizadoBtn.addEventListener("click", () => {
                const nombreInput = document.getElementById("nombrePersonalizado");
                const nombre = nombreInput.value;
                const precio = document.getElementById("precioPersonalizado").value;
                const cantidadPers = document.getElementById("cantidadPersonalizado").value;
                const notaPers = document.getElementById("notaPersonalizado").value;
                const errorMsg = document.getElementById("obligatorio");

                if (!nombre.trim()) {
                    nombreInput.classList.add("border-red-500");
                    nombreInput.focus();
                    errorMsg.classList.remove("hidden");
                    return;
                } else {
                    nombreInput.classList.remove("border-red-500");
                }

                fetch("/producto/guardar", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector(
                            'meta[name="csrf-token"]'
                        ).content,
                    },
                    body: JSON.stringify({
                        lista_compra_id: window.LISTA_ID,
                        nombre_producto: nombre,
                        precio: precio,
                        cantidad: cantidadPers,
                        notas: notaPers,
                        imagen: "",
                    }),
                })
                    .then((res) => res.json())
                    .then(() => {
                        document
                            .getElementById("modalPersonalizado")
                            .classList.add("hidden");
                    })
                    .catch((err) => {
                        console.error("Error al guardar personalizado:", err);
                    });
            });
        }
    });
}
