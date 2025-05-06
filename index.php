<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Noticias Tacna</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="contenedor">
        <!-- Encabezado -->
        <header class="encabezado">
            <img src="images/banner.png" alt="Banner Sistema de Noticias Tacna">
        </header>

        <!-- Barra de menú -->
        <nav class="barra-menu">
            <ul>
                <li><a href="index.php">|   Inicio  |</a></li>
                <li><a href="php/insertar_noticia.php">|    Insertar Noticias    |</a></li>
                <li><a href="php/editar_noticia.php">|  Editar Noticias    |</a></li>
                <li><a href="php/eliminar_noticia.php">|    Eliminar Noticias    |</a></li>
                <li><a href="php/listar_noticias.php">| Listar Noticias   |</a></li>
                <li><a href="php/buscar.php">|  Buscar |</a></li>
                <li><a href="php/consultas.php">|   Consultas   |</a></li>
                <li><a href="php/contacto.php">|    Contacto |</a></li>
            </ul>
        </nav>

        <div class="contenido-principal">
            <!-- Sección lateral -->
            <aside class="lateral">
                <h3>Últimas noticias en línea</h3>
                <?php
                // Incluir archivo de conexión
                require_once 'php/conexion.php';
                
                // Consulta para obtener las últimas 3 noticias
                $sql = "SELECT id_noticia, titulo FROM noticias ORDER BY fecha_publicacion DESC LIMIT 3";
                $resultado = $conexion->query($sql);
                
                if ($resultado && $resultado->num_rows > 0) {
                    echo "<ul style='padding-left: 15px;'>";
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<li><a href='php/ver_noticia.php?id=" . $fila['id_noticia'] . "'>" . $fila['titulo'] . "</a></li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No hay noticias disponibles.</p>";
                }
                ?>
            </aside>

            <!-- Contenido principal -->
            <main class="contenido">
                <h2>Noticias destacadas</h2>
                <?php
                // Consulta para obtener noticias destacadas
                $sql = "SELECT id_noticia, titulo, contenido, fecha_publicacion, imagen, 
                        (SELECT nombre FROM categorias WHERE id_categoria = noticias.id_categoria) AS categoria,
                        (SELECT nombre FROM usuarios WHERE id_usuario = noticias.id_autor) AS autor
                        FROM noticias 
                        WHERE destacada = 1 
                        ORDER BY fecha_publicacion DESC 
                        LIMIT 5";
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
        </div>

        <!-- Pie de página -->
        <footer class="pie-pagina">
            <div class="enlaces-pie">
                <a href="index.php">Inicio</a> | 
                <a href="php/listar_noticias.php">Listar Noticias</a> | 
                <a href="php/buscar.php">Buscar</a> | 
                <a href="php/contacto.php">Contacto</a>
            </div>
            <div class="copyright">
                Copyright Programación Web I 2024-II Tacna
            </div>
        </footer>
    </div>

    <script src="js/scripts.js"></script>
</body>
</html>