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
                <input type="text" name="q" placeholder="Buscar por título, contenido o autor..." 
                       value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" 
                       style="flex: 1; padding: 10px;">
                <input type="submit" value="Buscar" style="background-color: #800000; color: white; padding: 10px 20px; border: none; cursor: pointer;">
            </div>
        </form>
    </div>
    
    <!-- Resultados de la búsqueda -->
    <?php
    // Verificar si se realizó una búsqueda
    if (isset($_GET['q']) && !empty($_GET['q'])) {
        $busqueda = $conexion->real_escape_string($_GET['q']);
        
        // Consulta para buscar noticias
        $sql = "SELECT n.id_noticia, n.titulo, n.contenido, n.fecha_publicacion, n.imagen,
                c.nombre AS categoria, u.nombre AS autor
                FROM noticias n
                LEFT JOIN categorias c ON n.id_categoria = c.id_categoria
                LEFT JOIN usuarios u ON n.id_autor = u.id_usuario
                WHERE n.titulo LIKE '%$busqueda%' 
                OR n.contenido LIKE '%$busqueda%' 
                OR u.nombre LIKE '%$busqueda%'
                ORDER BY n.fecha_publicacion DESC";
        
        $resultado = $conexion->query($sql);
        
        // Mostrar resultados
        if ($resultado && $resultado->num_rows > 0) {
            echo "<h3>Resultados de la búsqueda para: \"" . htmlspecialchars($_GET['q']) . "\"</h3>";
            echo "<p>Se encontraron " . $resultado->num_rows . " resultados.</p>";
            
            while ($fila = $resultado->fetch_assoc()) {
                $resumen = substr($fila['contenido'], 0, 150) . '...';
                $fecha = date('d/m/Y', strtotime($fila['fecha_publicacion']));
                
                echo "<div style='margin-bottom: 20px; border: 1px solid #ddd; padding: 15px;'>";
                echo "<h3 style='color: #800000; margin-bottom: 5px;'>" . $fila['titulo'] . "</h3>";
                echo "<p style='color: #666; font-size: 12px; margin-bottom: 10px;'>Categoría: " . $fila['categoria'] . " | Fecha: " . $fecha . " | Autor: " . $fila['autor'] . "</p>";
                
                // Mostrar imagen en miniatura si existe
                if (!empty($fila['imagen'])) {
                    echo "<div style='float: left; margin-right: 15px; margin-bottom: 10px;'>";
                    echo "<img src='../uploads/" . $fila['imagen'] . "' alt='Imagen de la noticia' style='max-width: 100px; max-height: 80px; object-fit: cover;'>";
                    echo "</div>";
                }
                
                echo "<p>" . $resumen . "</p>";
                echo "<div style='clear: both;'></div>"; // Limpiar el float
                echo "<a href='ver_noticia.php?id=" . $fila['id_noticia'] . "' style='color: #800000; text-decoration: none; display: inline-block; margin-top: 10px;'>Leer más...</a>";
                echo "</div>";
            }
        } else {
            echo "<div style='text-align: center; padding: 30px; background-color: #f9f9f9; border-radius: 5px;'>";
            echo "<h3>No se encontraron resultados</h3>";
            echo "<p>No se encontraron noticias que coincidan con \"" . htmlspecialchars($_GET['q']) . "\".</p>";
            echo "<p>Sugerencias:</p>";
            echo "<ul style='list-style-type: none; padding: 0;'>";
            echo "<li>Verifica la ortografía de los términos de búsqueda.</li>";
            echo "<li>Intenta utilizar palabras más generales.</li>";
            echo "<li>Prueba con términos de búsqueda diferentes.</li>";
            echo "</ul>";
            echo "</div>";
        }
    } else {
        // Si no hay búsqueda, mostrar instrucciones
        echo "<div style='text-align: center; padding: 30px; background-color: #f9f9f9; border-radius: 5px;'>";
        echo "<h3>Buscar en el Sistema de Noticias</h3>";
        echo "<p>Utiliza el formulario de búsqueda para encontrar noticias por título, contenido o autor.</p>";
        echo "</div>";
    }
    
    // Cerrar la conexión
    $conexion->close();
    ?>
</main>

<?php
// Incluir el pie de página
include '../includes/footer.php';
?>