<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia - Sistema de Noticias Tacna</title>
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
                <h2>Editar Noticia</h2>
                
                <?php
                // Verificar si se proporcionó un ID
                if (!isset($_GET['id']) || empty($_GET['id'])) {
                    echo "<div style='color: red; margin-bottom: 20px;'>Error: No se especificó una noticia para editar.</div>";
                    echo "<a href='editar_noticia.php' style='background-color: #800000; color: white; padding: 8px 15px; text-decoration: none; display: inline-block;'>Volver</a>";
                } else {
                    $id_noticia = $conexion->real_escape_string($_GET['id']);
                    
                    // Consultar los datos de la noticia
                    $sql = "SELECT n.*, c.nombre AS categoria_nombre 
                            FROM noticias n 
                            JOIN categorias c ON n.id_categoria = c.id_categoria 
                            WHERE n.id_noticia = '$id_noticia'";
                    $resultado = $conexion->query($sql);
                    
                    if ($resultado && $resultado->num_rows > 0) {
                        $noticia = $resultado->fetch_assoc();
                        
                        // Mostrar mensaje de éxito si se actualizó correctamente
                        if (isset($_GET['actualizado']) && $_GET['actualizado'] == 'true') {
                            echo "<div style='background-color: #dff0d8; color: #3c763d; padding: 10px; margin-bottom: 20px; border-radius: 4px;'>
                                    La noticia se ha actualizado correctamente.
                                  </div>";
                        }
                        
                        // Formulario para editar la noticia
                        ?>
                        <form action="procesar_editar.php" method="post" enctype="multipart/form-data" style="max-width: 800px;">
                            <input type="hidden" name="id_noticia" value="<?php echo $noticia['id_noticia']; ?>">
                            
                            <div style="margin-bottom: 15px;">
                                <label for="titulo">Título:</label><br>
                                <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($noticia['titulo']); ?>" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            </div>
                            
                            <div style="margin-bottom: 15px;">
                                <label for="id_categoria">Categoría:</label><br>
                                <select id="id_categoria" name="id_categoria" required style="width: 100%; padding: 8px; margin-top: 5px;">
                                    <?php
                                    // Consultar todas las categorías
                                    $sql_categorias = "SELECT id_categoria, nombre FROM categorias ORDER BY nombre";
                                    $resultado_categorias = $conexion->query($sql_categorias);
                                    
                                    if ($resultado_categorias && $resultado_categorias->num_rows > 0) {
                                        while ($categoria = $resultado_categorias->fetch_assoc()) {
                                            $selected = ($categoria['id_categoria'] == $noticia['id_categoria']) ? 'selected' : '';
                                            echo "<option value='" . $categoria['id_categoria'] . "' $selected>" . $categoria['nombre'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div style="margin-bottom: 15px;">
                                <label for="contenido">Contenido:</label><br>
                                <textarea id="contenido" name="contenido" rows="10" required style="width: 100%; padding: 8px; margin-top: 5px;"><?php echo htmlspecialchars($noticia['contenido']); ?></textarea>
                            </div>
                            
                            <div style="margin-bottom: 15px;">
                                <label for="imagen">Imagen actual:</label><br>
                                <?php if (!empty($noticia['imagen'])): ?>
                                    <img src="../images/noticias/<?php echo $noticia['imagen']; ?>" alt="Imagen de la noticia" style="max-width: 200px; margin: 10px 0;">
                                    <p>Nombre del archivo: <?php echo $noticia['imagen']; ?></p>
                                <?php else: ?>
                                    <p>No hay imagen asociada a esta noticia.</p>
                                <?php endif; ?>
                                <label for="nueva_imagen">Cambiar imagen (opcional):</label><br>
                                <input type="file" id="nueva_imagen" name="nueva_imagen" style="margin-top: 5px;">
                                <input type="hidden" name="imagen_actual" value="<?php echo $noticia['imagen']; ?>">
                            </div>
                            
                            <div style="margin-bottom: 15px;">
                                <label for="destacada">¿Destacar noticia?</label>
                                <input type="checkbox" id="destacada" name="destacada" value="1" <?php echo ($noticia['destacada'] == 1) ? 'checked' : ''; ?>>
                            </div>
                            
                            <div style="margin-bottom: 15px;">
                                <label for="id_autor">Autor:</label><br>
                                <select id="id_autor" name="id_autor" required style="width: 100%; padding: 8px; margin-top: 5px;">
                                    <?php
                                    // Consultar todos los autores (usuarios)
                                    $sql_autores = "SELECT id_usuario, nombre FROM usuarios ORDER BY nombre";
                                    $resultado_autores = $conexion->query($sql_autores);
                                    
                                    if ($resultado_autores && $resultado_autores->num_rows > 0) {
                                        while ($autor = $resultado_autores->fetch_assoc()) {
                                            $selected = ($autor['id_usuario'] == $noticia['id_autor']) ? 'selected' : '';
                                            echo "<option value='" . $autor['id_usuario'] . "' $selected>" . $autor['nombre'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div style="display: flex; gap: 10px;">
                                <input type="submit" value="Guardar Cambios" style="background-color: #4CAF50; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                                <a href="editar_noticia.php" style="background-color: #f44336; color: white; padding: 10px 15px; text-decoration: none; display: inline-block;">Cancelar</a>
                            </div>
                        </form>
                        <?php
                    } else {
                        echo "<div style='color: red; margin-bottom: 20px;'>Error: No se encontró la noticia especificada.</div>";
                        echo "<a href='editar_noticia.php' style='background-color: #800000; color: white; padding: 8px 15px; text-decoration: none; display: inline-block;'>Volver</a>";
                    }
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