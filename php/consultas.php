<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultas - Sistema de Noticias Tacna</title>
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
                <h2>Consultas Estadísticas</h2>
                
                <div class="estadisticas">
                    <div class="tarjeta-estadistica" style="background-color: #f0f0f0; padding: 20px; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <h3 style="color: #800000; margin-bottom: 15px;">Noticias por Categoría</h3>
                        <?php
                        // Consulta para obtener el número de noticias por categoría
                        $sql = "SELECT c.nombre AS categoria, COUNT(n.id_noticia) AS total 
                                FROM categorias c
                                LEFT JOIN noticias n ON c.id_categoria = n.id_categoria
                                GROUP BY c.id_categoria
                                ORDER BY total DESC";
                        $resultado = $conexion->query($sql);
                        
                        if ($resultado && $resultado->num_rows > 0) {
                            echo "<table style='width: 100%; border-collapse: collapse;'>";
                            echo "<thead><tr style='background-color: #800000; color: white;'>";
                            echo "<th style='padding: 10px; text-align: left;'>Categoría</th>";
                            echo "<th style='padding: 10px; text-align: right;'>Total de Noticias</th>";
                            echo "</tr></thead><tbody>";
                            
                            while ($fila = $resultado->fetch_assoc()) {
                                echo "<tr style='border-bottom: 1px solid #ddd;'>";
                                echo "<td style='padding: 10px;'>" . $fila['categoria'] . "</td>";
                                echo "<td style='padding: 10px; text-align: right;'>" . $fila['total'] . "</td>";
                                echo "</tr>";
                            }
                            
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No hay datos disponibles.</p>";
                        }
                        ?>
                    </div>
                    
                    <div class="tarjeta-estadistica" style="background-color: #f0f0f0; padding: 20px; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <h3 style="color: #800000; margin-bottom: 15px;">Noticias Publicadas por Mes</h3>
                        <?php
                        // Consulta para obtener el número de noticias publicadas por mes
                        $sql = "SELECT DATE_FORMAT(fecha_publicacion, '%Y-%m') AS mes, 
                                COUNT(id_noticia) AS total 
                                FROM noticias 
                                GROUP BY mes 
                                ORDER BY mes DESC 
                                LIMIT 12";
                        $resultado = $conexion->query($sql);
                        
                        if ($resultado && $resultado->num_rows > 0) {
                            echo "<table style='width: 100%; border-collapse: collapse;'>";
                            echo "<thead><tr style='background-color: #800000; color: white;'>";
                            echo "<th style='padding: 10px; text-align: left;'>Mes</th>";
                            echo "<th style='padding: 10px; text-align: right;'>Total de Noticias</th>";
                            echo "</tr></thead><tbody>";
                            
                            while ($fila = $resultado->fetch_assoc()) {
                                // Formatear el mes para mostrar nombre del mes y año
                                $fecha = date_create($fila['mes'] . '-01');
                                $mes_formateado = date_format($fecha, 'F Y');
                                
                                echo "<tr style='border-bottom: 1px solid #ddd;'>";
                                echo "<td style='padding: 10px;'>" . $mes_formateado . "</td>";
                                echo "<td style='padding: 10px; text-align: right;'>" . $fila['total'] . "</td>";
                                echo "</tr>";
                            }
                            
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No hay datos disponibles.</p>";
                        }
                        ?>
                    </div>
                    
                    <div class="tarjeta-estadistica" style="background-color: #f0f0f0; padding: 20px; margin-bottom: 20px; border-radius: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <h3 style="color: #800000; margin-bottom: 15px;">Autores más Activos</h3>
                        <?php
                        // Consulta para obtener los autores con más noticias publicadas
                        $sql = "SELECT u.nombre AS autor, COUNT(n.id_noticia) AS total 
                                FROM usuarios u
                                LEFT JOIN noticias n ON u.id_usuario = n.id_autor
                                GROUP BY u.id_usuario
                                HAVING total > 0
                                ORDER BY total DESC
                                LIMIT 5";
                        $resultado = $conexion->query($sql);
                        
                        if ($resultado && $resultado->num_rows > 0) {
                            echo "<table style='width: 100%; border-collapse: collapse;'>";
                            echo "<thead><tr style='background-color: #800000; color: white;'>";
                            echo "<th style='padding: 10px; text-align: left;'>Autor</th>";
                            echo "<th style='padding: 10px; text-align: right;'>Noticias Publicadas</th>";
                            echo "</tr></thead><tbody>";
                            
                            while ($fila = $resultado->fetch_assoc()) {
                                echo "<tr style='border-bottom: 1px solid #ddd;'>";
                                echo "<td style='padding: 10px;'>" . $fila['autor'] . "</td>";
                                echo "<td style='padding: 10px; text-align: right;'>" . $fila['total'] . "</td>";
                                echo "</tr>";
                            }
                            
                            echo "</tbody></table>";
                        } else {
                            echo "<p>No hay datos disponibles.</p>";
                        }
                        ?>
                    </div>
                </div>
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