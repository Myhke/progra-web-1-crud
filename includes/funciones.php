<?php
/**
 * Muestra la sección lateral con formulario de login o información de usuario
 * 
 * @param object $conexion Conexión a la base de datos
 * @param string $ruta_base Ruta base para los enlaces
 */
function mostrar_sidebar($conexion, $ruta_base = '') {
    echo '<aside class="lateral">';
    
    // Verificar si hay una sesión de administrador activa
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_SESSION['admin_logueado']) && $_SESSION['admin_logueado'] === true) {
        // Mostrar información del usuario logueado
        echo '<div style="margin-bottom: 20px; padding: 15px; background-color: #f0f0f0; border-radius: 5px;">';
        echo '<h3 style="margin-top: 0; color: #800000;">Sesión Activa</h3>';
        echo '<p>Bienvenido, <strong>' . $_SESSION['admin_nombre'] . '</strong></p>';
        echo '<p><a href="' . $ruta_base . 'php/logout.php" style="color: #800000; text-decoration: none; display: inline-block; padding: 5px 10px; background-color: #f8d7da; border-radius: 3px;">Cerrar sesión</a></p>';
        echo '</div>';
    } else {
        // Mostrar formulario de login
        echo '<div style="margin-bottom: 20px; padding: 15px; background-color: #f0f0f0; border-radius: 5px;">';
        echo '<h3 style="margin-top: 0; color: #800000;">Iniciar Sesión</h3>';
        
        // Mostrar mensaje de error si existe
        if (isset($_SESSION['login_error'])) {
            echo '<div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 10px; border-radius: 3px; font-size: 14px;">';
            echo $_SESSION['login_error'];
            echo '</div>';
            // Limpiar el mensaje de error
            unset($_SESSION['login_error']);
        }
        
        echo '<form action="' . $ruta_base . 'php/login.php" method="post" style="margin-top: 10px;">';
        echo '<div style="margin-bottom: 10px;">';
        echo '<label for="email" style="display: block; margin-bottom: 5px;">Correo:</label>';
        echo '<input type="email" id="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">';
        echo '</div>';
        echo '<div style="margin-bottom: 10px;">';
        echo '<label for="password" style="display: block; margin-bottom: 5px;">Contraseña:</label>';
        echo '<input type="password" id="password" name="password" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 3px;">';
        echo '</div>';
        echo '<button type="submit" style="background-color: #800000; color: white; border: none; padding: 8px 15px; border-radius: 3px; cursor: pointer; width: 100%;">Ingresar</button>';
        echo '</form>';
        echo '</div>';
    }
    
    echo '</aside>';
}

/**
 * Muestra una noticia en formato resumido
 * 
 * @param array $noticia Datos de la noticia
 * @param string $ruta_base Ruta base para los enlaces
 */
function mostrar_noticia_resumida($noticia, $ruta_base = '') {
    $resumen = substr($noticia['contenido'], 0, 200) . '...';
    $fecha = date('d/m/Y', strtotime($noticia['fecha_publicacion']));
    
    echo "<div style='margin-bottom: 20px; border: 1px solid #ddd; padding: 15px;'>";
    echo "<h3 style='color: #800000; margin-bottom: 5px;'>" . $noticia['titulo'] . "</h3>";
    echo "<p style='color: #666; font-size: 12px; margin-bottom: 10px;'>Categoría: " . $noticia['categoria'] . " | Fecha: " . $fecha . " | Autor: " . $noticia['autor'] . "</p>";
    
    // Mostrar imagen en miniatura si existe
    if (!empty($noticia['imagen'])) {
        echo "<div style='float: left; margin-right: 15px; margin-bottom: 10px;'>";
        echo "<img src='" . $ruta_base . "uploads/" . $noticia['imagen'] . "' alt='Imagen de la noticia' style='max-width: 150px; max-height: 100px; object-fit: cover;'>";
        echo "</div>";
    }
    
    echo "<p>" . $resumen . "</p>";
    echo "<div style='clear: both;'></div>"; // Limpiar el float
    echo "<a href='" . $ruta_base . "php/ver_noticia.php?id=" . $noticia['id_noticia'] . "' style='color: #800000; text-decoration: none; display: inline-block; margin-top: 10px;'>Leer más...</a>";
    echo "</div>";
}

/**
 * Verifica si el usuario está logueado como administrador
 * 
 * @return bool True si está logueado, false en caso contrario
 */
function es_admin_logueado() {
    // Iniciar sesión si no está iniciada
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    return isset($_SESSION['admin_logueado']) && $_SESSION['admin_logueado'] === true;
}
?>