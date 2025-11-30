<?php
session_start();
include 'BD/database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo_usuario'];
    
    if($tipo_usuario == 'empleado') {
        // Buscar en la tabla de empleados
        $sql = "SELECT * FROM empleado WHERE Correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows == 1) {
            $empleado = $result->fetch_assoc();
            
            // Verificar contraseña (en producción debería estar encriptada)
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
        
    } elseif($tipo_usuario == 'paciente') {
        // Buscar en la tabla de pacientes
        $sql = "SELECT * FROM paciente WHERE Correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows == 1) {
            $paciente = $result->fetch_assoc();
            
            // Verificar contraseña (en producción debería estar encriptada)
            if($password == $paciente['Password']) {
                // Iniciar sesión de paciente
                $_SESSION['paciente'] = [
                    'id' => $paciente['ID_Paciente'],
                    'nombre' => $paciente['Nombre'] . ' ' . $paciente['Apellido'],
                    'email' => $paciente['Correo']
                ];
                
                header('Location: pacientes/dashboard.php');
                exit();
            }
        }
    }
    
    // Si llegamos aquí, las credenciales son incorrectas
    header('Location: login.php?error=1');
    exit();
}

$conexion->close();
?>