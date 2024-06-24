<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "imperialtech";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener datos de ventas
$sql = "SELECT id_venta, u.nombre AS nombre_usuario, p.nom_producto AS nombre_producto, v.cantidad, v.precio_total, v.fecha_venta, v.metodo_pago 
        FROM venta v
        JOIN usuario u ON v.id_usuario = u.id_usuario
        JOIN producto p ON v.id_producto = p.id_producto";
$result = $conn->query($sql);

// Crear un array para almacenar los datos
$ventas = [];

if ($result->num_rows > 0) {
    // Obtener cada fila de resultados
    while ($row = $result->fetch_assoc()) {
        $ventas[] = $row;
    }
} else {
    echo "No hay datos de ventas.";
}

// Cerrar la conexión
$conn->close();

// Devolver los datos como JSON
echo json_encode($ventas);
?>
