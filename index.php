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
    <h2>Noticias Destacadas</h2>
    
    <?php
    // Consulta para obtener noticias destacadas
    $sql = "SELECT n.id_noticia, n.titulo, n.contenido, n.fecha_publicacion, n.imagen, c.nombre as categoria, a.nombre as autor 
            FROM noticias n 
            INNER JOIN categorias c ON n.id_categoria = c.id_categoria 
            INNER JOIN autores a ON n.id_autor = a.id_autor 
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