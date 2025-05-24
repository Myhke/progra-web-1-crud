<?php
// Incluir archivos necesarios
require_once 'includes/config.php';
require_once 'includes/funciones.php';
require_once 'php/conexion.php';

// Definir título de la página
$titulo_pagina = 'Inicio - Sistema de Noticias Tacna';

// Incluir el encabezado
include 'includes/header.php';

// Mostrar la barra lateral
mostrar_sidebar($conexion, $ruta_base);
?>

<!-- Contenido principal -->
<main class="contenido">
    <h2>Última Noticia</h2>
    
    <?php
    // Consulta para obtener la noticia más reciente
    $sql_reciente = "SELECT 
        n.id_noticia, 
        n.titulo, 
        n.contenido, 
        n.fecha_publicacion, 
        n.imagen, 
        c.nombre AS categoria, 
        a.nombre AS autor 
    FROM 
        noticias n
    INNER JOIN 
        categorias c ON n.id_categoria = c.id_categoria
    INNER JOIN 
        usuarios a ON n.id_autor = a.id_usuario  -- Corregir el nombre de la columna id_autor -> id_usuario
    ORDER BY 
        n.fecha_publicacion DESC
    LIMIT 1";
    
    $resultado_reciente = $conexion->query($sql_reciente);
    
    if ($resultado_reciente && $resultado_reciente->num_rows > 0) {
        $noticia_reciente = $resultado_reciente->fetch_assoc();
        echo "<div style='margin-bottom: 30px; padding: 15px; border: 2px solid #800000; border-radius: 5px;'>";
        echo "<h3 style='color: #800000; margin-bottom: 5px;'>" . $noticia_reciente['titulo'] . "</h3>";
        $fecha = date('d/m/Y', strtotime($noticia_reciente['fecha_publicacion']));
        echo "<p style='color: #666; font-size: 12px; margin-bottom: 10px;'>Categoría: " . $noticia_reciente['categoria'] . " | Fecha: " . $fecha . " | Autor: " . $noticia_reciente['autor'] . "</p>";
        
        // Mostrar imagen si existe
        if (!empty($noticia_reciente['imagen'])) {
            echo "<div style='text-align: center; margin-bottom: 15px;'>";
            echo "<img src='http://161.132.68.64/imagenes/" . $noticia_reciente['imagen'] . "' alt='Imagen de la noticia' style='max-width: 100%; max-height: 300px;'>";
            echo "</div>";
        }
        
        // Mostrar contenido completo o resumen
        echo "<div style='line-height: 1.6;'>";
        echo nl2br(substr($noticia_reciente['contenido'], 0, 300)) . "...";
        echo "</div>";
        
        echo "<div style='margin-top: 15px;'>";
        echo "<a href='php/ver_noticia.php?id=" . $noticia_reciente['id_noticia'] . "' style='color: #800000; text-decoration: none; font-weight: bold;'>Leer noticia completa →</a>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "<p>No hay noticias disponibles.</p>";
    }
    ?>
    
    <h2>Noticias Destacadas</h2>
    
    <?php
    // Consulta para obtener noticias destacadas
    $sql = "SELECT n.id_noticia, n.titulo, n.contenido, n.fecha_publicacion, n.imagen, c.nombre as categoria, u.nombre as autor 
    FROM noticias n 
    INNER JOIN categorias c ON n.id_categoria = c.id_categoria 
    LEFT JOIN usuarios u ON n.id_autor = u.id_usuario 
    WHERE n.destacada = 1 
    ORDER BY n.fecha_publicacion DESC 
    LIMIT 3";
    
    $resultado = $conexion->query($sql);
    
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            mostrar_noticia_resumida($fila, $ruta_base);
        }
    } else {
        echo "<p>No hay noticias destacadas disponibles.</p>";
    }
    
    // Cerrar la conexión
    $conexion->close();
    ?>
</main>

<?php
// Incluir el pie de página
include 'includes/footer.php';
?>