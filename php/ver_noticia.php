<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Noticia - Sistema de Noticias Tacna</title>
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
                <?php
                // Verificar si se proporcionó un ID
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $id_noticia = $conexion->real_escape_string($_GET['id']);
                    
                    // Consulta para obtener los detalles de la noticia
                    $sql = "SELECT n.id_noticia, n.titulo, n.contenido, n.fecha_publicacion, n.imagen,
                            c.nombre AS categoria, u.nombre AS autor
                            FROM noticias n
                            LEFT JOIN categorias c ON n.id_categoria = c.id_categoria
                            LEFT JOIN usuarios u ON n.id_autor = u.id_usuario
                            WHERE n.id_noticia = '$id_noticia'";
                    
                    $resultado = $conexion->query($sql);
                    
                    if ($resultado && $resultado->num_rows > 0) {
                        $noticia = $resultado->fetch_assoc();
                        $fecha = date('d/m/Y', strtotime($noticia['fecha_publicacion']));
                        
                        echo "<h2>" . $noticia['titulo'] . "</h2>";
                        echo "<p style='color: #666; font-size: 14px; margin-bottom: 20px;'>Categoría: " . $noticia['categoria'] . " | Fecha: " . $fecha . " | Autor: " . $noticia['autor'] . "</p>";
                        
                        // Mostrar imagen si existe
                        if (!empty($noticia['imagen'])) {
                            echo "<div style='text-align: center; margin-bottom: 20px;'>";
                            echo "<img src='http://161.132.68.64/imagenes/" . $noticia['imagen'] . "' alt='Imagen de la noticia' style='max-width: 100%; max-height: 400px;'>";
                            echo "</div>";
                        }
                        
                        // Mostrar contenido completo
                        echo "<div style='line-height: 1.6;'>";
                        echo nl2br($noticia['contenido']);
                        echo "</div>";
                        
                        echo "<div style='margin-top: 30px;'>";
                        echo "<a href='listar_noticias.php' style='color: #800000; text-decoration: none;'>← Volver al listado de noticias</a>";
                        echo "</div>";
                    } else {
                        echo "<div style='text-align: center; padding: 50px 0;'>";
                        echo "<h2>Noticia no encontrada</h2>";
                        echo "<p>La noticia que estás buscando no existe o ha sido eliminada.</p>";
                        echo "<a href='listar_noticias.php' style='color: #800000; text-decoration: none;'>Volver al listado de noticias</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<div style='text-align: center; padding: 50px 0;'>";
                    echo "<h2>Noticia no especificada</h2>";
                    echo "<p>No se ha especificado qué noticia deseas ver.</p>";
                    echo "<a href='listar_noticias.php' style='color: #800000; text-decoration: none;'>Volver al listado de noticias</a>";
                    echo "</div>";
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