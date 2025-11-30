<?php include 'BD/header.php'; ?>

<h2>Iniciar Sesión</h2>

<?php
// Mostrar mensajes de error
if(isset($_GET['error'])) {
    echo "<p style='color: red;'>Usuario o contraseña incorrectos</p>";
}
?>

<div style="max-width: 400px; margin: 0 auto;">
    <form action="procesar_login_completo.php" method="POST">
        <div style="margin-bottom: 15px;">
            <label>Tipo de Usuario:</label>
            <select name="tipo_usuario" style="width: 100%; padding: 8px;" required>
                <option value="empleado">Empleado (Admin, Recepcionista, Dentista)</option>
                <option value="paciente">Paciente</option>
            </select>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label>Correo electrónico:</label>
            <input type="email" name="email" style="width: 100%; padding: 8px;" required>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label>Contraseña:</label>
            <input type="password" name="password" style="width: 100%; padding: 8px;" required>
        </div>
        
        <button type="submit" style="background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; width: 100%;">
            Iniciar Sesión
        </button>
    </form>
    
    <div style="margin-top: 20px; text-align: center;">
        <p>¿No tienes cuenta? <a href="registro_paciente.php">Regístrate como paciente</a></p>
    </div>
    
    <div style="margin-top: 20px; background: #f8f9fa; padding: 15px; border-radius: 5px;">
        <p><strong>Datos de prueba - Empleados:</strong></p>
        <p>Admin: admin@consultorio.com / 123456</p>
        <p>Dentista: dentista@consultorio.com / 123456</p>
        <p>Recepcionista: recepcion@consultorio.com / 123456</p>
        
        <p style="margin-top: 10px;"><strong>Paciente de prueba:</strong></p>
        <p>paciente@ejemplo.com / 123456</p>
    </div>
</div>

<?php include 'BD/footer.php'; ?>