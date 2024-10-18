$(document).ready(function() {
    // Evento para eliminar un producto
    $('a[data-action="eliminar"]').click(function(e) {
        e.preventDefault(); // Evitar que el enlace recargue la página

        var idProducto = $(this).data('id'); // Obtener el ID del producto
        console.log(idProducto); // Verifica el ID
        if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
            // Enviar datos mediante AJAX a eliminar.php
            $.ajax({
                url: '/appweb/controller/eliminar.php',
                type: 'POST',
                data: { idProd: idProducto }, // Enviar el ID del producto
                success: function(response) {
                    console.log(response); // Verificar respuesta
                    let jsonResponse = JSON.parse(response);
                    if (jsonResponse.success) {
                        alert("Producto eliminado con éxito."); // Mensaje de éxito
                        // Aquí puedes actualizar la tabla para reflejar la eliminación
                        // Por ejemplo, eliminar la fila de la tabla:
                        // $(this).closest('tr').remove(); // Asegúrate de usar el contexto correcto
                        location.reload(); // O recargar la página
                    } else {
                        alert("Error: " + jsonResponse.error); // Mensaje de error
                    }
                }
            });
        }
    });
});
