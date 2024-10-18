$(document).ready(function() {
    // Evento para llenar los campos del modal al abrirlo
    $('#exampleModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var id = button.data('id'); // Extraer la información de los atributos data-*
        var name = button.data('name');
        var price = button.data('price');
        var stock = button.data('stock')

        // Llenar los campos del modal
        $('#idProducto').val(id); // Establecer el ID en el campo oculto
        $('#nombre').val(name);    // Establecer el nombre
        $('#precio').val(price);   // Establecer el precio
        $('#existencia').val(stock);   // Establecer el stock
     
        if (!id) {
            $('#exampleModalLabel').text('Agregar Producto'); // Cambia 'modalHeader' al ID de tu encabezado
            $('#guardarProducto').text('Agregar'); // Cambiar el texto del botón
        }else{
            // Cambiar el encabezado del modal
            $('#exampleModalLabel').text('Modificar Producto'); // Cambia 'modalHeader' al ID de tu encabezado
            $('#guardarProducto').text('Actualizar'); // Cambiar el texto del botón
        }
        
         
    });
});
