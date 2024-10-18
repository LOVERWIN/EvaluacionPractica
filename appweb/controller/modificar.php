<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../conexion.php');
$con = conectaDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $existencia = $_POST['existencia'];

    $sql = "UPDATE tb_productos SET Nombre=?, Precio=?, Ext=? WHERE idPro=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sdii", $nombre, $precio, $existencia, $idProducto);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }

    $stmt->close();
}
?>
