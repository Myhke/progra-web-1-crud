<?php
// Incluir archivo de configuración
require_once '../includes/config.php';

// Definir título de la página
$titulo_pagina = 'Buscar Noticias - Sistema de Noticias Tacna';

// Incluir el encabezado
include '../includes/header.php';
?>

<!-- Sección lateral -->
<aside class="lateral">
    <h3>Últimas noticias en línea</h3>
    <?php
    // Incluir archivo de conexión
    require_once 'conexion.php';
    
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
            echo "<a href='ver_noticia.php?id=" . $fila['id_noticia'] . "' style='color: #800000; text-decoration: none;'>" . $fila['titulo'] . "</a>";
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
    <h2>Buscar Noticias</h2>
    
    <!-- Formulario de búsqueda -->
    <div style="margin-bottom: 30px;">
        <form action="buscar.php" method="get">
            <div style="display: flex; gap: 10px;">
                <input type="text" name="q" placeholder="Buscar por título, contenido o autor..." style="flex: 1; padding: 8px;" value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
                <select name="categoria" style="padding: 8px;">
                    <option value="">Todas las categorías</option>
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
                <input type="submit" value="Buscar" style="background-color: #800000; color: white; padding: 8px 15px; border: none; cursor: pointer;">
            </div>
        </form>
    </div>
    
    <!-- Resultados de la búsqueda -->
    <?php
    if (isset($_GET['q']) || isset($_GET['categoria'])) {
        $busqueda = isset($_GET['q']) ? $conexion->real_escape_string($_GET['q']) : '';
        $categoria = isset($_GET['categoria']) ? $conexion->real_escape_string($_GET['categoria']) : '';
        
        // Construir la consulta SQL
        $sql = "SELECT n.id_noticia, n.titulo, n.contenido, n.fecha_publicacion, c.nombre as categoria, a.nombre as autor 
                FROM noticias n 
                INNER JOIN categorias c ON n.id_categoria = c.id_categoria 
                INNER JOIN autores a ON n.id_autor = a.id_autor 
                WHERE 1=1";
        
        if (!empty($busqueda)) {
            $sql .= " AND (n.titulo LIKE '%$busqueda%' OR n.contenido LIKE '%$busqueda%' OR a.nombre LIKE '%$busqueda%')";
        }
        
        if (!empty($categoria)) {
            $sql .= " AND n.id_categoria = '$categoria'";
        }
        
        $sql .= " ORDER BY n.fecha_publicacion DESC";
        
        $resultado = $conexion->query($sql);
        
        // Mostrar resultados
        if ($resultado && $resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $resumen = substr($fila['contenido'], 0, 200) . '...';
                $fecha = date('d/m/Y', strtotime($fila['fecha_publicacion']));
                
                echo "<div style='margin-bottom: 20px; border: 1px solid #ddd; padding: 15px;'>";
                echo "<h3 style='color: #800000; margin-bottom: 5px;'>" . $fila['titulo'] . "</h3>";
                echo "<p style='color: #666; font-size: 12px; margin-bottom: 10px;'>Categoría: " . $fila['categoria'] . " | Fecha: " . $fecha . " | Autor: " . $fila['autor'] . "</p>";
                echo "<p>" . $resumen . "</p>";
                echo "<a href='ver_noticia.php?id=" . $fila['id_noticia'] . "' style='color: #800000; text-decoration: none; display: inline-block; margin-top: 10px;'>Leer más...</a>";
                echo "</div>";
            }
            
            // Paginación (simplificada)
            echo "<div style='text-align: center; margin-top: 20px;'>";
            echo "<a href='#' style='padding: 5px 10px; margin: 0 5px; border: 1px solid #ddd; text-decoration: none; color: #800000;'>1</a>";
            echo "</div>";
        } else {
            echo "<p>No se encontraron resultados para su búsqueda.</p>";
        }
    } else {
        echo "<p>Utilice el formulario de búsqueda para encontrar noticias.</p>";
    }
    
    // Cerrar la conexión
    $conexion->close();
    ?>
</main>

<?php
// Incluir el pie de página
include '../includes/footer.php';
?>