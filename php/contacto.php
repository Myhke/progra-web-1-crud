<?php
// Incluir archivo de conexión
require_once 'conexion.php';

// Procesar el formulario de contacto si se envió
$mensaje_enviado = false;
$error_mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $email = $conexion->real_escape_string($_POST['email']);
    $asunto = $conexion->real_escape_string($_POST['asunto']);
    $mensaje = $conexion->real_escape_string($_POST['mensaje']);
    
    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($asunto) || empty($mensaje)) {
        $error_mensaje = "Por favor, complete todos los campos.";
    } else {
        // Insertar el mensaje en la base de datos
        $sql = "INSERT INTO mensajes_contacto (nombre, email, asunto, mensaje, fecha_envio) 
                VALUES ('$nombre', '$email', '$asunto', '$mensaje', NOW())";
        
        if ($conexion->query($sql) === TRUE) {
            $mensaje_enviado = true;
        } else {
            $error_mensaje = "Error al enviar el mensaje: " . $conexion->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Sistema de Noticias Tacna</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="contenedor">
        <!-- Encabezado -->
        <header class="encabezado">
            <img src="../images/banner.png" alt="Banner Sistema de Noticias Tacna">
        </header>

        <!-- Barra de menú -->
        <nav class="barra-menu">
            <ul>
                <li><a href="../index.php">|   Inicio  |</a></li>
                <li><a href="insertar_noticia.php">|    Insertar Noticias    |</a></li>
                <li><a href="editar_noticia.php">|  Editar Noticias    |</a></li>
                <li><a href="eliminar_noticia.php">|    Eliminar Noticias    |</a></li>
                <li><a href="listar_noticias.php">| Listar Noticias   |</a></li>
                <li><a href="buscar.php">|  Buscar |</a></li>
                <li><a href="consultas.php">|   Consultas   |</a></li>
                <li><a href="contacto.php">|    Contacto |</a></li>
            </ul>
        </nav>

        <div class="contenido-principal">
            <!-- Sección lateral -->
            <aside class="lateral">
                <h3>Últimas noticias en línea</h3>
                <?php
                // Consulta para obtener las últimas 3 noticias
                $sql = "SELECT id_noticia, titulo FROM noticias ORDER BY fecha_publicacion DESC LIMIT 3";
                $resultado = $conexion->query($sql);
                
                if ($resultado && $resultado->num_rows > 0) {
                    echo "<ul style='padding-left: 15px;'>";
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<li><a href='ver_noticia.php?id=" . $fila['id_noticia'] . "'>" . $fila['titulo'] . "</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No hay noticias disponibles.</p>";
                }
                ?>
            </aside>

            <!-- Contenido principal -->
            <main class="contenido">
                <h2>Contacto</h2>
                
                <div style="margin-bottom: 30px;">
                    <h3 style="color: #800000; margin-bottom: 15px;">Información de Contacto</h3>
                    
                    <?php
                    // Consulta para obtener información de contacto
                    $sql = "SELECT * FROM informacion_contacto WHERE activo = 1 LIMIT 1";
                    $resultado = $conexion->query($sql);
                    
                    if ($resultado && $resultado->num_rows > 0) {
                        $contacto = $resultado->fetch_assoc();
                        
                        echo "<div style='background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>";
                        echo "<p><strong>Dirección:</strong> " . $contacto['direccion'] . "</p>";
                        echo "<p><strong>Teléfono:</strong> " . $contacto['telefono'] . "</p>";
                        echo "<p><strong>Email:</strong> " . $contacto['email'] . "</p>";
                        echo "<p><strong>Horario de Atención:</strong> " . $contacto['horario'] . "</p>";
                        echo "</div>";
                    } else {
                        // Información predeterminada si no hay datos en la base de datos
                        echo "<div style='background-color: #f9f9f9; padding: 20px; border-radius: 5px; margin-bottom: 20px;'>";
                        echo "<p><strong>Dirección:</strong> Av. Bolognesi 123, Tacna</p>";
                        echo "<p><strong>Teléfono:</strong> (052) 123-4567</p>";
                        echo "<p><strong>Email:</strong> contacto@noticiastacna.com</p>";
                        echo "<p><strong>Horario de Atención:</strong> Lunes a Viernes de 8:00 am a 6:00 pm</p>";
                        echo "</div>";
                    }
                    ?>
                </div>
                
                <!-- Mostrar mensaje de éxito o error -->
                <?php if ($mensaje_enviado): ?>
                <div style="background-color: #dff0d8; color: #3c763d; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                    Su mensaje ha sido enviado correctamente. Nos pondremos en contacto con usted pronto.
                </div>
                <?php elseif (!empty($error_mensaje)): ?>
                <div style="background-color: #f2dede; color: #a94442; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                    <?php echo $error_mensaje; ?>
                </div>
                <?php endif; ?>
                
                <!-- Formulario de contacto -->
                <div style="margin-top: 30px;">
                    <h3 style="color: #800000; margin-bottom: 15px;">Envíenos un mensaje</h3>
                    
                    <form action="contacto.php" method="post" style="max-width: 600px;">
                        <div style="margin-bottom: 15px;">
                            <label for="nombre">Nombre completo:</label><br>
                            <input type="text" id="nombre" name="nombre" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="email">Correo electrónico:</label><br>
                            <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="asunto">Asunto:</label><br>
                            <input type="text" id="asunto" name="asunto" required style="width: 100%; padding: 8px; box-sizing: border-box;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="mensaje">Mensaje:</label><br>
                            <textarea id="mensaje" name="mensaje" rows="6" required style="width: 100%; padding: 8px; box-sizing: border-box;"></textarea>
                        </div>
                        
                        <div>
                            <input type="submit" value="Enviar mensaje" style="background-color: #800000; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
            </main>
        </div>

        <!-- Pie de página -->
        <footer class="pie-pagina">
            <div class="enlaces-pie">
                <a href="../index.php">Inicio</a> | 
                <a href="listar_noticias.php">Listar Noticias</a> | 
                <a href="buscar.php">Buscar</a> | 
                <a href="contacto.php">Contacto</a>
            </div>
            <div class="copyright">
                Copyright Programación Web I 2024-II Tacna
            </div>
        </footer>
    </div>

    <script src="../js/scripts.js"></script>
</body>
</html>