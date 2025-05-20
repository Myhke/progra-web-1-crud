<?php
// Incluir archivo de configuración
require_once 'includes/config.php';

// Definir título de la página
$titulo_pagina = 'Inicio - Sistema de Noticias Tacna';

// Incluir el encabezado
include 'includes/header.php';
?>

<!-- Sección lateral -->
<aside class="lateral">
    <h3>Últimas noticias en línea</h3>
    <?php
    // Incluir archivo de conexión
    require_once 'php/conexion.php';
    
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
            echo "<a href='php/ver_noticia.php?id=" . $fila['id_noticia'] . "' style='color: #800000; text-decoration: none;'>" . $fila['titulo'] . "</a>";
            echo "<br><small style='color: #666;'>" . date('d/m/Y', strtotime($fila['fecha_publicacion'])) . "</small>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No hay noticias recientes.</p>";
    }
    ?>
</aside>

<!-- Contenido principal -->
<main class="contenido">
    <h2>Noticias Destacadas</h2>
    
    <?php
    // Consulta para obtener noticias destacadas
    $sql = "SELECT n.id_noticia, n.titulo, n.contenido, n.fecha_publicacion, c.nombre as categoria, a.nombre as autor 
            FROM noticias n 
            INNER JOIN categorias c ON n.id_categoria = c.id_categoria 
            INNER JOIN autores a ON n.id_autor = a.id_autor 
            WHERE n.destacada = 1 
            ORDER BY n.fecha_publicacion DESC 
            LIMIT 3";
    
    $resultado = $conexion->query($sql);
    
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $resumen = substr($fila['contenido'], 0, 200) . '...';
            $fecha = date('d/m/Y', strtotime($fila['fecha_publicacion']));
            
            echo "<div style='margin-bottom: 20px; border: 1px solid #ddd; padding: 15px;'>";
            echo "<h3 style='color: #800000; margin-bottom: 5px;'>" . $fila['titulo'] . "</h3>";
            echo "<p style='color: #666; font-size: 12px; margin-bottom: 10px;'>Categoría: " . $fila['categoria'] . " | Fecha: " . $fecha . " | Autor: " . $fila['autor'] . "</p>";
            echo "<p>" . $resumen . "</p>";
            echo "<a href='php/ver_noticia.php?id=" . $fila['id_noticia'] . "' style='color: #800000; text-decoration: none; display: inline-block; margin-top: 10px;'>Leer más...</a>";
            echo "</div>";
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