<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../conexion.php');
$conn = conectaDB();

$idProd = $_POST['idProd']; // Asegúrate de que el nombre del campo sea correcto
$idProd = mysqli_real_escape_string($conn, $idProd);

// Consulta para eliminar el producto
$sql = "DELETE FROM tb_productos WHERE idPro='$idProd'";
$result = mysqli_query($conn, $sql);

// Verificar si se eliminó un producto
if (mysqli_affected_rows($conn) > 0) {
    echo json_encode(["success" => true, "message" => "Producto eliminado con éxito."]);
} else {
    echo json_encode(["success" => false, "message" => "No se encontró el producto con ID: $idProd."]);
}

// Cerrar conexión
mysqli_close($conn);
?>