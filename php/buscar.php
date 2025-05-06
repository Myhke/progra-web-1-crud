<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Noticias - Sistema de Noticias Tacna</title>
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
                <h2>Buscar Noticias</h2>
                
                <!-- Formulario de búsqueda avanzada -->
                <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 15px; background-color: #f9f9f9;">
                    <h3 style="margin-bottom: 15px; color: #800000;">Búsqueda Avanzada</h3>
                    <form action="buscar.php" method="get">
                        <div style="margin-bottom: 15px;">
                            <label for="termino">Término de búsqueda:</label><br>
                            <input type="text" id="termino" name="termino" style="width: 100%; padding: 8px; margin-top: 5px;" value="<?php echo isset($_GET['termino']) ? htmlspecialchars($_GET['termino']) : ''; ?>">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="categoria">Categoría:</label><br>
                            <select id="categoria" name="categoria" style="width: 100%; padding: 8px; margin-top: 5px;">
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
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="fecha_desde">Desde fecha:</label><br>
                            <input type="date" id="fecha_desde" name="fecha_desde" style="width: 100%; padding: 8px; margin-top: 5px;" value="<?php echo isset($_GET['fecha_desde']) ? htmlspecialchars($_GET['fecha_desde']) : ''; ?>">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="fecha_hasta">Hasta fecha:</label><br>
                            <input type="date" id="fecha_hasta" name="fecha_hasta" style="width: 100%; padding: 8px; margin-top: 5px;" value="<?php echo isset($_GET['fecha_hasta']) ? htmlspecialchars($_GET['fecha_hasta']) : ''; ?>">
                        </div>
                        
                        <div>
                            <input type="submit" value="Buscar" style="background-color: #800000; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
                
                <!-- Resultados de búsqueda -->
                <h3 style="margin-bottom: 15px;">Resultados de la búsqueda</h3>
                
                <?php
                // Verificar si se ha realizado una búsqueda
                if (isset($_GET['termino']) || isset($_GET['categoria']) || isset($_GET['fecha_desde']) || isset($_GET['fecha_hasta'])) {
                    // Construir la consulta SQL base
                    $sql = "SELECT n.id_noticia, n.titulo, n.contenido, n.fecha_publicacion, 
                            c.nombre AS categoria, u.nombre AS autor
                            FROM noticias n
                            LEFT JOIN categorias c ON n.id_categoria = c.id_categoria
                            LEFT JOIN usuarios u ON n.id_autor = u.id_usuario
                            WHERE 1=1";
                    
                    // Agregar condiciones según los parámetros de búsqueda
                    if (!empty($_GET['termino'])) {
                        $termino = $conexion->real_escape_string($_GET['termino']);
                        $sql .= " AND (n.titulo LIKE '%$termino%' OR n.contenido LIKE '%$termino%')";
                    }
                    
                    if (!empty($_GET['categoria'])) {
                        $categoria = $conexion->real_escape_string($_GET['categoria']);
                        $sql .= " AND n.id_categoria = '$categoria'";
                    }
                    
                    if (!empty($_GET['fecha_desde'])) {
                        $fecha_desde = $conexion->real_escape_string($_GET['fecha_desde']);
                        $sql .= " AND n.fecha_publicacion >= '$fecha_desde'";
                    }
                    
                    if (!empty($_GET['fecha_hasta'])) {
                        $fecha_hasta = $conexion->real_escape_string($_GET['fecha_hasta']);
                        $sql .= " AND n.fecha_publicacion <= '$fecha_hasta 23:59:59'";
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