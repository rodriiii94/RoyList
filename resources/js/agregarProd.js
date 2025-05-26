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
        
        document
        .getElementById("cancelarNota")
        .addEventListener("click", () => {
            document.getElementById("modalNota").classList.add("hidden");
        });
        
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
                alert("Producto añadido a tu lista ✅");
            })
            .catch((err) => {
                console.log("Este es el producto:", productoSeleccionado);
                console.error("Error al guardar:", err);
                alert("He llehado a agregarProd.js");
            });
        });
    });
}
