<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro eadj.admin</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido</h1>
        <form id="registroForm" method="POST" action="registro.php">
            <h2>Formulario de Registro</h2>
            <input type="text" id="nombre" name="nombre" placeholder="nombre" required>
            <input type="email" id="email" name="email" placeholder="email" required>
            <input type="text" id="direccion" name="direccion" placeholder="dirección" required>
            <input type="tel" id="telefono" name="telefono" placeholder="teléfono" required>
            <input type="password" id="contrasena" name="contrasena" placeholder="contraseña" required>
            <input type="date" id="fecha" name="fecha" required>
            <button type="submit">Registrarme</button>
        </form>
    </div>
</body>
</html>
