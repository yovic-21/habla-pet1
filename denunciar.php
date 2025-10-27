<?php
// --- Conexión a MySQL en Wasmer con puerto ---
$host = "db.fr-pari1.bengt.wasmernet.com";
$usuario = "ebfe99f5782b800084ba2feb57ce";
$contraseña = "068febfe-99f5-79ec-8000-b5a53f9f318b";
$base_de_datos = "habla_pet";
$puerto = 10272;

$conexion = new mysqli($host, $usuario, $contraseña, $base_de_datos, $puerto);

// Verificar conexión
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// --- Guardar denuncia cuando se envía el formulario ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tipo = $conexion->real_escape_string($_POST["tipo"]);
    $lugar = $conexion->real_escape_string($_POST["lugar"]);
    $descripcion = $conexion->real_escape_string($_POST["descripcion"]);
    $fecha = $_POST["fecha"];
    $nombre = $conexion->real_escape_string($_POST["nombre"]);

    if(empty($nombre)) $nombre = "Anónimo";

    $sql = "INSERT INTO denuncias (tipo, lugar, descripcion, fecha, nombre)
            VALUES ('$tipo', '$lugar', '$descripcion', '$fecha', '$nombre')";

    if ($conexion->query($sql) === TRUE) {
        echo "<script>alert('✅ Denuncia registrada con éxito');</script>";
    } else {
        echo "<script>alert('❌ Error al guardar: " . $conexion->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Hacer Denuncia - HABLA PET</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>🐾 HABLA PET</h1>
    <nav>
        <a href="index.php">🏠 Inicio</a>
        <a href="denunciar.php">📝 Hacer Denuncia</a>
        <a href="admin.php">🔐 Admin</a>
    </nav>
</header>

<main>
    <h2>Formulario de Denuncias</h2>
    <form method="POST" action="">
        <label for="tipo">Tipo de denuncia:</label><br>
        <select id="tipo" name="tipo" required>
            <option value="">-- Selecciona una opción --</option>
            <option value="abandono">Abandono de animales</option>
            <option value="alimentacion">Falta de alimento o agua</option>
            <option value="maltrato">Maltrato físico</option>
            <option value="explotacion">Explotación animal</option>
        </select><br><br>

        <label for="lugar">Lugar del hecho:</label><br>
        <input type="text" id="lugar" name="lugar" required><br><br>

        <label for="descripcion">Descripción de los hechos:</label><br>
        <textarea id="descripcion" name="descripcion" rows="5" required></textarea><br><br>

        <label for="fecha">Fecha del hecho:</label><br>
        <input type="date" id="fecha" name="fecha" required><br><br>

        <label for="nombre">Tu nombre (opcional):</label><br>
        <input type="text" id="nombre" name="nombre" placeholder="Anónimo"><br><br>

        <button type="submit">Enviar Denuncia</button>
    </form>
</main>
</body>
</html>
