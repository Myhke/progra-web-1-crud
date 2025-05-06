<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Noticias - Sistema de Noticias Tacna</title>
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
                <h2>Eliminar Noticias</h2>
                
                <!-- Formulario de búsqueda para eliminar -->
                <div style="margin-bottom: 20px;">
                    <form action="eliminar_noticia.php" method="get">
                        <div style="display: flex; gap: 10px;">
                            <input type="text" name="buscar" placeholder="Buscar noticia por título..." style="flex: 1; padding: 8px;">
                            <input type="submit" value="Buscar" style="background-color: #800000; color: white; padding: 8px 15px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
                
                <!-- Tabla de resultados desde la base de datos -->
                <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                    <thead>
                        <tr style="background-color: #f0f0f0;">
                            <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">ID</th>
                            <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Título</th>
                            <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Categoría</th>
                            <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Fecha</th>
                            <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Construir la consulta SQL base
                        $sql = "SELECT n.id_noticia, n.titulo, c.nombre AS categoria, n.fecha_publicacion 
                                FROM noticias n
                                LEFT JOIN categorias c ON n.id_categoria = c.id_categoria";
                        
                        // Agregar filtro de búsqueda si está presente
                        if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
                            $buscar = $conexion->real_escape_string($_GET['buscar']);
                            $sql .= " WHERE n.titulo LIKE '%$buscar%'";
                        }
                        
                        // Ordenar por fecha de publicación descendente
                        $sql .= " ORDER BY n.fecha_publicacion DESC";
                        
                        // Ejecutar la consulta
                        $resultado = $conexion->query($sql);
                        
                        // Mostrar resultados
                        if ($resultado && $resultado->num_rows > 0) {
                            while ($fila = $resultado->fetch_assoc()) {
                                $fecha = date('d/m/Y', strtotime($fila['fecha_publicacion']));
                                echo "<tr>";
                                echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $fila['id_noticia'] . "</td>";
                                echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $fila['titulo'] . "</td>";
                                echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $fila['categoria'] . "</td>";
                                echo "<td style='padding: 10px; border: 1px solid #ddd;'>" . $fecha . "</td>";
                                echo "<td style='padding: 10px; text-align: center; border: 1px solid #ddd;'>";
                                echo "<a href='javascript:confirmarEliminar(" . $fila['id_noticia'] . ")' style='background-color: #800000; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px;'>Eliminar</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' style='padding: 10px; text-align: center;'>No se encontraron noticias.</td></tr>";
                        }
                        
                        // Cerrar la conexión
                        $conexion->close();
                        ?>
                    </tbody>
                </table>
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
    <script>
        function confirmarEliminar(id) {
            if (confirm('¿Está seguro que desea eliminar esta noticia?')) {
                window.location.href = 'procesar_eliminar.php?id=' + id;
            }
        }
    </script>
</body>
</html>