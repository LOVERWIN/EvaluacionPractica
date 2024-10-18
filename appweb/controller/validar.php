<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Inicia la sesión

// Incluye la conexión a la base de datos
include('../conexion.php');
$conn = conectaDB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Escapa las entradas del usuario para prevenir inyecciones SQL
    $usuario = mysqli_real_escape_string($conn, $_POST['loginUsername']);
    $contrasena = mysqli_real_escape_string($conn, $_POST['loginPassword']);

    // Primera consulta para validar si el usuario existe en tb_usuarios
    $sql_usuario = "SELECT idUser, NomUser FROM tb_usuarios WHERE NomUser='$usuario' AND Passwd='$contrasena'";
    $result_usuario = mysqli_query($conn, $sql_usuario);

    if (mysqli_num_rows($result_usuario) == 1) {
        // Si el usuario existe, se obtiene su idUser
        $row_usuario = mysqli_fetch_assoc($result_usuario);
        $idUser = $row_usuario['idUser'];

        // Segunda consulta para obtener los detalles desde tb_usuarios_detalles
        $sql_detalles = "SELECT Nombre, ApellidoPaterno, ApellidoMaterno FROM tb_usuarios_detalles WHERE idUser='$idUser'";
        $result_detalles = mysqli_query($conn, $sql_detalles);

        if (mysqli_num_rows($result_detalles) == 1) {
            // Si se encuentran los detalles del usuario
            $row_detalles = mysqli_fetch_assoc($result_detalles);

            // Construir el nombre completo
            $nombreCompleto = $row_usuario['NomUser'].'-['. $row_detalles['Nombre'] . ' ' . $row_detalles['ApellidoPaterno'] . ' ' . $row_detalles['ApellidoMaterno'].']';

            // Guardar los datos en la sesión
            $_SESSION['nom_completo'] = $nombreCompleto; // Guardar el nombre completo en la sesión
            $_SESSION['login'] = "true"; // Establecer la sesión de login
            $_SESSION['nomusuario'] = $row_usuario['NomUser']; // Guardar el nombre de usuario

            // Respuesta JSON indicando éxito
            echo json_encode(array('success' => 1));
        } else {
            // Si no se encuentran detalles del usuario
            echo json_encode(array('success' => 0, 'message' => 'Detalles del usuario no encontrados.'));
        }
    } else {
        // Si las credenciales son incorrectas
        echo json_encode(array('success' => 0, 'message' => 'Usuario o contraseña incorrectos.'));
    }

    // Cierra la conexión
    mysqli_close($conn);
} else {
    // Si el método de solicitud no es POST
    echo json_encode(array('success' => 0, 'message' => 'Método no permitido.'));
}
?>
