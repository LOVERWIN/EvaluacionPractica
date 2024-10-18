$(document).ready(function() {

    // Evento de clic para el botón "Guardar" (cambiar a "Actualizar")
    $('#guardarProducto').click(function(e) {
        e.preventDefault();

        let idProducto = $('#idProducto').val(); // Obtener el ID del producto
        let nombre = $('#nombre').val();
        let precio = $('#precio').val();
        let existencia = $('#existencia').val();

        // Validar campos vacíos
        if (nombre === "" || precio === "" || existencia === "") {
            alert("Todos los campos son obligatorios.");
            return false;
        }

        // Validar que el precio y la existencia sean correctos
        if (parseFloat(precio) <= 0) {
            alert("El precio debe ser un número positivo.");
            return false;
        }

        if (parseInt(existencia) < 0) {
            alert("La existencia debe ser un número entero positivo.");
            return false;
        }

        // Determinar si se está agregando o modificando un producto
        let isModifying = idProducto !== ""; // Verifica si existen datos en existencia

        // Enviar datos mediante AJAX a actualizar.php o agregar.php según el caso
        let url = isModifying ? '/appweb/controller/modificar.php' : '/appweb/controller/insertar.php';

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                idProducto: idProducto,  // Incluir el ID del producto (puede ser nulo al agregar)
                nombre: nombre,
                precio: parseFloat(precio),  // Convertir a flotante
                existencia: parseInt(existencia)  // Convertir a entero
            },
            success: function(response) {
                console.log(response);  // Verificar Errores
                let jsonResponse = JSON.parse(response);
                if (jsonResponse.success) {
                    alert(isModifying ? "Producto modificado con éxito." : "Producto agregado con éxito.");
                    location.reload(); // Recargar la página después de la actualización o adición
                } else {
                    alert("Error al " + (isModifying ? "modificar" : "agregar") + " el producto.");
                }
            }
        });
    });
});
