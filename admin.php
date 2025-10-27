<?php
// --- Conexión a MySQL ---
$conexion = new mysqli("localhost", "root", "", "habla_pet");

// Verificar conexión
if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

// --- Verificar login del administrador ---
$usuario_valido = "admin";
$password_valido = "12345";
$logueado = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usuario"])) {
  $usuario = $_POST["usuario"];
  $password = $_POST["password"];

  if ($usuario === $usuario_valido && $password === $password_valido) {
    $logueado = true;
  } else {
    echo "<script>alert('❌ Usuario o contraseña incorrectos');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Admin - HABLA PET</title>
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
    <h2>Panel de Administrador</h2>

    <?php if (!$logueado): ?>
      <!-- Formulario de acceso -->
      <form method="POST" action="">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario" required><br><br>

        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Ingresar</button>
      </form>
    <?php else: ?>
      <!-- Lista de denuncias -->
      <h3>📋 Denuncias registradas</h3>
      <table border="1" cellpadding="10" cellspacing="0" style="margin:auto; border-collapse:collapse;">
        <tr style="background:#2c3e50; color:white;">
          <th>ID</th>
          <th>Tipo</th>
          <th>Lugar</th>
          <th>Descripción</th>
          <th>Fecha</th>
          <th>Nombre</th>
        </tr>

        <?php
        $resultado = $conexion->query("SELECT * FROM denuncias ORDER BY id DESC");

        if ($resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                    <td>{$fila['id']}</td>
                    <td>{$fila['tipo']}</td>
                    <td>{$fila['lugar']}</td>
                    <td>{$fila['descripcion']}</td>
                    <td>{$fila['fecha']}</td>
                    <td>{$fila['nombre']}</td>
                  </tr>";
          }
        } else {
          echo "<tr><td colspan='6'>No hay denuncias registradas.</td></tr>";
        }
        ?>
      </table>
    <?php endif; ?>
  </main>
</body>
</html>
