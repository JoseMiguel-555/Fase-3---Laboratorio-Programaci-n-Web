<?php
session_start();
include 'BD/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $direccion = trim($_POST['direccion']);
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $rfc = trim($_POST['rfc']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validaciones básicas
    if(empty($nombre) || empty($apellido) || empty($correo) || empty($telefono) || empty($password)) {
        header('Location: registro_paciente.php?error=campos_vacios');
        exit();
    }
    
    if($password !== $confirm_password) {
        header('Location: registro_paciente.php?error=password_no_coincide');
        exit();
    }
    
    if(strlen($password) < 6) {
        header('Location: registro_paciente.php?error=password_corto');
        exit();
    }
    
    // Validar que el email no exista
    $sql_check = "SELECT ID_Paciente FROM paciente WHERE Correo = ?";
    $stmt_check = $conexion->prepare($sql_check);
    $stmt_check->bind_param("s", $correo);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if($result_check->num_rows > 0) {
        header('Location: registro_paciente.php?error=email_existe');
        exit();
    }
    
    // En un sistema real, aquí encriptaríamos la contraseña
    // $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    // Insertar nuevo paciente (por ahora guardamos la contraseña en texto plano para pruebas)
    $sql = "INSERT INTO paciente (Nombre, Apellido, Telefono, Correo, Direccion, Fecha_Nacimiento, RFC, Password) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssss", $nombre, $apellido, $telefono, $correo, $direccion, $fecha_nacimiento, $rfc, $password);
    
    if($stmt->execute()) {
        header('Location: registro_paciente.php?success=1');
    } else {
        header('Location: registro_paciente.php?error=registro_fallo');
    }
    
    $conexion->close();
} else {
    header('Location: registro_paciente.php');
    exit();
}
?>