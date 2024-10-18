
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../conexion.php');
$con = conectaDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $precio = floatval($_POST['precio']);  // Asegurarse de que sea flotante
    $existencia = intval($_POST['existencia']);  // Asegurarse de que sea entero

    // Validar que los valores sean correctos
    if (empty($nombre) || $precio <= 0 || $existencia < 0) {
        echo json_encode(['success' => false, 'message' => 'Datos inválidos.']);
        exit;
    }

    // Inserción en la base de datos
    $sql = "INSERT INTO tb_productos (Nombre, Precio, Ext) VALUES ('$nombre', $precio, $existencia)";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al insertar el producto.']);
    }
}
?>
