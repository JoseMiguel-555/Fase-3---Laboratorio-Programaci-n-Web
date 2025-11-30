<?php
session_start();
include 'BD/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Buscar en la tabla de empleados
    $sql = "SELECT * FROM empleado WHERE Correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows == 1) {
        $empleado = $result->fetch_assoc();
        
        // Verificar contraseña
        if($password == $empleado['Password']) {
            // Iniciar sesión
            $_SESSION['usuario'] = [
                'id' => $empleado['ID_Empleado'],
                'nombre' => $empleado['Nombre'] . ' ' . $empleado['Apellido'],
                'email' => $empleado['Correo'],
                'puesto' => $empleado['Puesto']
            ];
            
            // Redirigir según el rol
            switch($empleado['Puesto']) {
                case 'Administrador':
                    header('Location: admin/dashboard.php');
                    break;
                case 'Dentista':
                    header('Location: dentista/dashboard.php');
                    break;
                case 'Recepcionista':
                    header('Location: recepcionista/dashboard.php');
                    break;
                default:
                    header('Location: index.php');
            }
            exit();
        }
    }
    
    // Si llegamos aquí, las credenciales son incorrectas
    header('Location: login.php?error=1');
    exit();
}
?>