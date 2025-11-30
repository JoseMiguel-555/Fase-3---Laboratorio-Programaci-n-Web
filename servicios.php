<?php include 'BD/header.php'; ?>

<h2>Nuestros Servicios Dentales</h2>
<p>Ofrecemos una amplia gama de tratamientos para cuidar tu salud bucal</p>

<?php
include 'BD/database.php';
$sql = "SELECT * FROM servicios";
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

<?php include 'BD/footer.php'; ?>