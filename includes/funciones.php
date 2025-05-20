<?php
/**
 * Muestra la sección lateral con las últimas noticias
 * 
 * @param object $conexion Conexión a la base de datos
 * @param string $ruta_base Ruta base para los enlaces
 */
function mostrar_sidebar($conexion, $ruta_base = '') {
    echo '<aside class="lateral">';
    echo '<h3>Últimas noticias en línea</h3>';
    
    // Consulta para obtener las últimas 5 noticias
    $sql = "SELECT n.id_noticia, n.titulo, n.fecha_publicacion 
            FROM noticias n 
            ORDER BY n.fecha_publicacion DESC 
            LIMIT 5";
    
    $resultado = $conexion->query($sql);
    
    if ($resultado && $resultado->num_rows > 0) {
        echo "<ul style='list-style-type: none; padding: 0;'>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<li style='margin-bottom: 10px;'>";
            echo "<a href='" . $ruta_base . "php/ver_noticia.php?id=" . $fila['id_noticia'] . "' style='color: #800000; text-decoration: none;'>" . $fila['titulo'] . "</a>";
            echo "<br><small style='color: #666;'>" . date('d/m/Y', strtotime($fila['fecha_publicacion'])) . "</small>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay noticias recientes.</p>";
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
?>