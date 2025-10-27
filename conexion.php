<?php
$host = "db.fr-pari1.bengt.wasmernet.com";
$usuario = "ebfe99f5782b800084ba2feb57ce";
$contraseña = "068febfe-99f5-79ec-8000-b5a53f9f318b";
$base_de_datos = "habla_pet";
$puerto = 10272;  // Muy importante

$conn = new mysqli($host, $usuario, $contraseña, $base_de_datos, $puerto);

if ($conn->connect_error) {
    die("❌ Error de conexión: " . $conn->connect_error);
}
?>
