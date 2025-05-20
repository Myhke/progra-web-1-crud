<?php
// Incluir archivo de configuración
require_once '../includes/config.php';

// Definir título de la página
$titulo_pagina = 'Contacto - Sistema de Noticias Tacna';

// Incluir el encabezado
include '../includes/header.php';
?>

<!-- Sección lateral -->
<aside class="lateral">
    <h3>Últimas noticias en línea</h3>
    <?php
    // Incluir archivo de conexión
    require_once 'conexion.php';
    
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
    
    <div style="display: flex; flex-wrap: wrap; gap: 30px;">
        <!-- Formulario de contacto -->
        <div style="flex: 2; min-width: 300px;">
            <h3>Envíanos un mensaje</h3>
            
            <?php
            // Procesar el formulario cuando se envía
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Aquí iría el código para procesar el formulario
                // Por ahora, solo mostraremos un mensaje de éxito
                echo "<div style='background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;'>";
                echo "¡Gracias por contactarnos! Tu mensaje ha sido enviado correctamente.";
                echo "</div>";
            }
            ?>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
                <div style="margin-bottom: 15px;">
                    <label for="nombre">Nombre completo:</label><br>
                    <input type="text" id="nombre" name="nombre" required style="width: 100%; padding: 8px; margin-top: 5px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label for="email">Correo electrónico:</label><br>
                    <input type="email" id="email" name="email" required style="width: 100%; padding: 8px; margin-top: 5px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label for="asunto">Asunto:</label><br>
                    <input type="text" id="asunto" name="asunto" required style="width: 100%; padding: 8px; margin-top: 5px;">
                </div>
                
                <div style="margin-bottom: 15px;">
                    <label for="mensaje">Mensaje:</label><br>
                    <textarea id="mensaje" name="mensaje" rows="6" required style="width: 100%; padding: 8px; margin-top: 5px;"></textarea>
                </div>
                
                <div>
                    <input type="submit" value="Enviar Mensaje" style="background-color: #800000; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                </div>
            </form>
        </div>
        
        <!-- Información de contacto -->
        <div style="flex: 1; min-width: 250px;">
            <h3>Información de contacto</h3>
            
            <div style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
                <p><strong>Sistema de Noticias Tacna</strong></p>
                <p><i class="fa fa-map-marker"></i> Dirección: Av. Bolognesi 1234, Tacna</p>
                <p><i class="fa fa-phone"></i> Teléfono: (052) 123-4567</p>
                <p><i class="fa fa-envelope"></i> Email: info@noticiastacna.com</p>
                <p><i class="fa fa-clock-o"></i> Horario de atención: Lunes a Viernes, 9:00 - 18:00</p>
                
                <div style="margin-top: 20px;">
                    <h4>Síguenos en redes sociales</h4>
                    <div style="display: flex; gap: 10px; margin-top: 10px;">
                        <a href="#" style="color: #3b5998; font-size: 24px;"><i class="fa fa-facebook-square"></i></a>
                        <a href="#" style="color: #1da1f2; font-size: 24px;"><i class="fa fa-twitter-square"></i></a>
                        <a href="#" style="color: #c32aa3; font-size: 24px;"><i class="fa fa-instagram"></i></a>
                        <a href="#" style="color: #ff0000; font-size: 24px;"><i class="fa fa-youtube-square"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Mapa (simulado) -->
    <div style="margin-top: 30px;">
        <h3>Nuestra ubicación</h3>
        <div style="background-color: #eee; height: 300px; display: flex; justify-content: center; align-items: center; border-radius: 5px;">
            <p>Aquí iría un mapa de Google Maps</p>
        </div>
    </div>
</main>

<?php
// Incluir el pie de página
include '../includes/footer.php';
?>