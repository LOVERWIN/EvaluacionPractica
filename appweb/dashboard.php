<?php
    session_start();
    if (!isset($_SESSION['login']))
        header("location: index.php");
?>
<html>
<head>
    <title>Sistema de Pruebas UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
    <link href="css/cmce-styles.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Validación con jQuery -->
	<script src="/appweb/js/modal_new_producto.js"></script>
	<script src="/appweb/js/modal_actualizar_producto.js"></script>
	<script src="/appweb/js/eliminarProducto.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand"><b>Nombre de usuario:</b>  <?php echo isset($_SESSION['nom_completo']) ? $_SESSION['nom_completo'] : 'Invitado'; ?></p></a> 
        <a href="cerrar.php"><button class="btn btn-warning">Cerrar Sesión</button></a>
    </div>
</nav>
<center>
    <br><br><br><br>

    <form action="dashboard.php" method="GET">
        <div class="formpanel" id="f1">
            <b>Buscar producto por precio mayor a:</b> <input type="text" name="pre" size="4">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <br><br>
    <hr>
    <br><br>

    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Nuevo Producto
    </button>

    <br><br>

    <?php
        include('conexion.php');
        $con = conectaDB();
        if (isset($_GET['pre']))
            $sql = "SELECT idPro,Nombre,Precio,Ext FROM tb_productos WHERE Precio > " . $_GET['pre'];
        else
            $sql = "SELECT idPro,Nombre,Precio,Ext FROM tb_productos";

        echo "<table class='table' style='width:570px;'>";
        echo "<thead class='table-dark'>";
        echo "<th>Nombre</th>";
        echo "<th>Precio</th>";
		echo "<th>Existencia</th>";
		echo "<th>Acciones</th>";
        echo "<th></th>";
        echo "</thead>";
        echo "<tbody>";

        $resultado = mysqli_query($con, $sql);  
		while ($fila = mysqli_fetch_row($resultado)) {
			echo "<tr>";
			echo "<td>" . $fila[1] . "</td>";
			echo "<td>" . $fila[2] . "</td>";
			echo "<td>" . $fila[3] . "</td>";
			echo "<td>
					<a href='#' 
					   data-id='" . $fila[0] . "' 
					   data-name='" . $fila[1] . "' 
					   data-price='" . $fila[2] . "' 
					   data-stock='" . $fila[3] . "' 
					   data-bs-toggle='modal' 
					   data-bs-target='#exampleModal'>
					   <img src='iconomodificar.png' width='20' height='20' title='Modificar'> 
					</a>
					<a href='#eliminarProducto'
						data-id='" . $fila[0] . "' 
						data-action= 'eliminar'>
					    <img src='iconoeliminar.png' width='20' height='20' title='Eliminar'>
					</a>
				  </td>";
			echo "</tr>";
		}
        echo "</tbody> </table>";
    ?>
<!-- Modal Ventada de Nuevo Producto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formProducto">
                    <input type="hidden" id="idProducto" name="idProducto" value=""> <!-- Campo oculto para el ID del producto -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="existencia" class="form-label">Existencia</label>
                        <input type="number" class="form-control" id="existencia" name="existencia" step="1" min="0" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success" id="guardarProducto">Guardar</button>
            </div>
        </div>
    </div>
</div>


</center>

    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white"><b>UC: Desarrollo de aplicaciones web y móviles [ Dr. Christian Mauricio Castillo Estrada ]</b></p>
        </div>
    </footer>

</body>
</html>
