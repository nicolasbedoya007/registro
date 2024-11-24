<?php
// Mostrar errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuración de cabecera para JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Verificar si la solicitud es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Configuración de conexión
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registro";
    $port = 3305;

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Verificar conexión
    if ($conn->connect_error) {
        die(json_encode(["success" => false, "message" => "Conexión fallida: " . $conn->connect_error]));
    }

    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    $fecha = $_POST['fecha'] ?? '';

    // Hash de la contraseña
    $hashed_password = password_hash($contrasena, PASSWORD_DEFAULT);

    // Verificar si el usuario ya existe
    $stmt = $conn->prepare("SELECT * FROM datos WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Este usuario ya está registrado."]);
    } else {
        // Insertar nuevo usuario
        $stmt = $conn->prepare("INSERT INTO datos (nombre, email, direccion, telefono, contrasena, fecha) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $nombre, $email, $direccion, $telefono, $hashed_password, $fecha);

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Felicidades, ya estás registrado."]);
        } else {
            echo json_encode(["success" => false, "message" => "Error al registrar: " . $stmt->error]);
        }
    }

    // Cerrar conexiones
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Método de solicitud no soportado."]);
}
?>
