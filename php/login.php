<?php
// Iniciar sesión
session_start();

// Incluir archivo de conexión
require_once 'conexion.php';

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Validar los datos
    if (empty($email) || empty($password)) {
        $error_message = "Por favor, complete todos los campos.";
    } else {
        // Consultar la base de datos para verificar las credenciales
        // Nota: Esta consulta compara directamente la contraseña sin hash
        $sql = "SELECT id_usuario, nombre, email, password FROM usuarios WHERE email = ? AND password = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if ($resultado->num_rows == 1) {
            $usuario = $resultado->fetch_assoc();
            
            // Iniciar sesión directamente sin verificar hash
            $_SESSION['admin_logueado'] = true;
            $_SESSION['admin_id'] = $usuario['id_usuario'];
            $_SESSION['admin_nombre'] = $usuario['nombre'];
            $_SESSION['admin_email'] = $usuario['email'];
            
            // Redirigir a la página anterior o a la página principal
            $pagina_anterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
            header("Location: $pagina_anterior");
            exit;
        } else {
            $error_message = "Credenciales incorrectas.";
        }
    }
    
    // Si hay un error, redirigir a la página anterior con el mensaje de error
    if (isset($error_message)) {
        $_SESSION['login_error'] = $error_message;
        $pagina_anterior = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../index.php';
        header("Location: $pagina_anterior");
        exit;
    }
}

// Si no es una solicitud POST, redirigir a la página principal
header("Location: ../index.php");
exit;
?>