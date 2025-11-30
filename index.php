<?php include 'BD/header.php'; ?>

<h2>Bienvenido al Consultorio Dental</h2>
<p>Sistema de reserva de citas en línea - Cuidamos tu sonrisa con profesionalismo</p>

<hr>

<h3>Nuestros Servicios Dentales</h3>
<?php
include 'BD/database.php';
$sql = "SELECT * FROM servicios LIMIT 3";
$result = $conexion->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='servicio'>";
        echo "<h4>" . $row["Nombre_Servicio"] . "</h4>";
        echo "<p>" . $row["Descripcion"] . "</p>";
        echo "<p><strong>Precio: $" . $row["Costo"] . "</strong></p>";
        echo "</div>";
    }
} else {
    echo "<p>No hay servicios disponibles.</p>";
}
$conexion->close();
?>

<div style="text-align: center; margin: 30px 0;">
    <a href="servicios.php" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Ver Todos los Servicios</a>
</div>

<?php include 'BD/footer.php'; ?>