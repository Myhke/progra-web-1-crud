<?php
// Incluir archivo de configuración
require_once '../includes/config.php';

// Definir título de la página
$titulo_pagina = 'Listar Noticias - Sistema de Noticias Tacna';

// Incluir archivo de conexión
require_once 'conexion.php';

// Incluir funciones
require_once '../includes/funciones.php';

// Incluir el encabezado
include '../includes/header.php';

// Mostrar la barra lateral con el formulario de login
mostrar_sidebar($conexion, '../');
?>

<!-- Contenido principal -->
<main class="contenido">
    <h2>Listado de Noticias</h2>
    
    <!-- Filtros -->
    <div style="margin-bottom: 20px;">
        <form action="listar_noticias.php" method="get">
            <div style="display: flex; gap: 10px; align-items: center;">
                <label for="categoria">Filtrar por categoría:</label>
                <select id="categoria" name="categoria" style="padding: 8px;">
                    <option value="">Todas</option>
                    <?php
                    // Consulta para obtener todas las categorías
                    $sql_cat = "SELECT id_categoria, nombre FROM categorias ORDER BY nombre";
                    $resultado_cat = $conexion->query($sql_cat);
                    
                    if ($resultado_cat && $resultado_cat->num_rows > 0) {
                        while ($fila_cat = $resultado_cat->fetch_assoc()) {
                            $selected = (isset($_GET['categoria']) && $_GET['categoria'] == $fila_cat['id_categoria']) ? 'selected' : '';
                            echo "<option value='" . $fila_cat['id_categoria'] . "' $selected>" . $fila_cat['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                <input type="submit" value="Filtrar" style="background-color: #800000; color: white; padding: 8px 15px; border: none; cursor: pointer;">
            </div>
        </form>
    </div>
    
    <!-- Listado de noticias -->
    <?php
    // Construir la consulta SQL base
    $sql = "SELECT n.id_noticia, n.titulo, n.contenido, n.fecha_publicacion, n.imagen,
            c.nombre AS categoria, u.nombre AS autor
            FROM noticias n
            LEFT JOIN categorias c ON n.id_categoria = c.id_categoria
            LEFT JOIN usuarios u ON n.id_autor = u.id_usuario";
    
    // Agregar filtro por categoría si está seleccionado
    if (isset($_GET['categoria']) && !empty($_GET['categoria'])) {
        $categoria = $conexion->real_escape_string($_GET['categoria']);
        $sql .= " WHERE n.id_categoria = '$categoria'";
    }
    
    // Ordenar por fecha de publicación descendente
    $sql .= " ORDER BY n.fecha_publicacion DESC";
    
    // Ejecutar la consulta
    $resultado = $conexion->query($sql);
    
    // Mostrar resultados
    if ($resultado && $resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $resumen = substr($fila['contenido'], 0, 200) . '...';
            $fecha = date('d/m/Y', strtotime($fila['fecha_publicacion']));
            
            echo "<div style='margin-bottom: 20px; border: 1px solid #ddd; padding: 15px;'>";
            echo "<h3 style='color: #800000; margin-bottom: 5px;'>" . $fila['titulo'] . "</h3>";
            echo "<p style='color: #666; font-size: 12px; margin-bottom: 10px;'>Categoría: " . $fila['categoria'] . " | Fecha: " . $fecha . " | Autor: " . $fila['autor'] . "</p>";
            
            // Mostrar imagen en miniatura si existe
            if (!empty($fila['imagen'])) {
                echo "<div style='float: left; margin-right: 15px; margin-bottom: 10px;'>";
                echo "<img src='../uploads/" . $fila['imagen'] . "' alt='Imagen de la noticia' style='max-width: 150px; max-height: 100px; object-fit: cover;'>";
                echo "</div>";
            }
            
            echo "<p>" . $resumen . "</p>";
            echo "<div style='clear: both;'></div>"; // Limpiar el float
            echo "<a href='ver_noticia.php?id=" . $fila['id_noticia'] . "' style='color: #800000; text-decoration: none; display: inline-block; margin-top: 10px;'>Leer más...</a>";
            echo "</div>";
        }
        
        // Paginación (simplificada)
        echo "<div style='text-align: center; margin-top: 20px;'>";
        echo "<a href='#' style='padding: 5px 10px; margin: 0 5px; border: 1px solid #ddd; text-decoration: none; color: #800000;'>1</a>";
        echo "</div>";
    } else {
        echo "<p>No hay noticias disponibles.</p>";
    }
    
    // Cerrar la conexión
    $conexion->close();
    ?>
</main>

<?php
// Incluir el pie de página
include '../includes/footer.php';
?>