<?php include 'BD/header.php'; ?>

<h2>Registro de Paciente</h2>

<?php
// Mostrar mensajes de éxito/error
if(isset($_GET['success'])) {
    echo "<div style='background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;'>
            ✅ Registro exitoso. Ahora puedes iniciar sesión.
          </div>";
}

if(isset($_GET['error'])) {
    $errores = [
        'email_existe' => '❌ El email ya está registrado',
        'campos_vacios' => '❌ Todos los campos son obligatorios',
        'registro_fallo' => '❌ Error en el registro, intenta nuevamente'
    ];
    if(isset($errores[$_GET['error']])) {
        echo "<div style='background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin-bottom: 20px;'>" . $errores[$_GET['error']] . "</div>";
    }
}
?>

<div style="max-width: 600px; margin: 0 auto;">
    <form action="procesar_registro_paciente.php" method="POST">
        <h3>Información Personal</h3>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
            <div>
                <label>Nombre *:</label>
                <input type="text" name="nombre" style="width: 100%; padding: 8px;" required 
                       value="<?php echo $_POST['nombre'] ?? ''; ?>">
            </div>
            <div>
                <label>Apellido *:</label>
                <input type="text" name="apellido" style="width: 100%; padding: 8px;" required
                       value="<?php echo $_POST['apellido'] ?? ''; ?>">
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px;">
            <div>
                <label>Email *:</label>
                <input type="email" name="correo" style="width: 100%; padding: 8px;" required
                       value="<?php echo $_POST['correo'] ?? ''; ?>">
            </div>
            <div>
                <label>Teléfono *:</label>
                <input type="text" name="telefono" style="width: 100%; padding: 8px;" required
                       value="<?php echo $_POST['telefono'] ?? ''; ?>">
            </div>
        </div>
        
        <div style="margin-bottom: 10px;">
            <label>Dirección:</label>
            <textarea name="direccion" style="width: 100%; padding: 8px; height: 60px;"
                      placeholder="Calle, número, colonia, ciudad..."><?php echo $_POST['direccion'] ?? ''; ?></textarea>
        </div>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px;">
            <div>
                <label>Fecha de Nacimiento:</label>
                <input type="date" name="fecha_nacimiento" style="width: 100%; padding: 8px;"
                       value="<?php echo $_POST['fecha_nacimiento'] ?? ''; ?>">
            </div>
            <div>
                <label>RFC:</label>
                <input type="text" name="rfc" style="width: 100%; padding: 8px;"
                       value="<?php echo $_POST['rfc'] ?? ''; ?>" placeholder="Opcional para facturación">
            </div>
        </div>
        
        <h3>Datos de Acceso</h3>
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px;">
            <div>
                <label>Contraseña *:</label>
                <input type="password" name="password" style="width: 100%; padding: 8px;" required minlength="6">
                <small>Mínimo 6 caracteres</small>
            </div>
            <div>
                <label>Confirmar Contraseña *:</label>
                <input type="password" name="confirm_password" style="width: 100%; padding: 8px;" required>
            </div>
        </div>
        
        <div style="background: #e9ecef; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
            <p style="margin: 0; font-size: 14px;">
                📝 <strong>Nota:</strong> Al registrarte, podrás agendar y gestionar tus citas en línea, 
                ver tu historial y recibir recordatorios.
            </p>
        </div>
        
        <button type="submit" style="background: #28a745; color: white; padding: 12px 30px; border: none; border-radius: 5px; font-size: 16px; width: 100%;">
            📝 Registrarme como Paciente
        </button>
        
        <div style="text-align: center; margin-top: 20px;">
            <p>¿Ya tienes cuenta? <a href="/consultorio_dental/login.php" style="color: #007bff;">Inicia Sesión aquí</a></p>
        </div>
    </form>
</div>

<?php include 'BD/footer.php'; ?>