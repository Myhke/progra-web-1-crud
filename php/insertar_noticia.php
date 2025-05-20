<?php
// Iniciar sesión
session_start();

// Incluir archivo de conexión
require_once 'conexion.php';
require_once '../includes/funciones.php';

// Verificar si el usuario está logueado
$usuario_logueado = es_admin_logueado();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Noticias - Sistema de Noticias Tacna</title>
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
                <?php if ($usuario_logueado): ?>
                <li><a href="insertar_noticia.php">|    Insertar Noticias    |</a></li>
                <li><a href="editar_noticia.php">|  Editar Noticias    |</a></li>
                <li><a href="eliminar_noticia.php">|    Eliminar Noticias    |</a></li>
                <?php endif; ?>
                <li><a href="listar_noticias.php">| Listar Noticias   |</a></li>
                <li><a href="buscar.php">|  Buscar |</a></li>
                <?php if ($usuario_logueado): ?>
                <li><a href="consultas.php">|   Consultas   |</a></li>
                <?php endif; ?>
                <li><a href="contacto.php">|    Contacto |</a></li>
                <?php if ($usuario_logueado): ?>
                <li><a href="logout.php">|   Cerrar Sesión   |</a></li>
                <?php else: ?>
                <li><a href="login.php">|   Iniciar Sesión   |</a></li>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="contenido-principal">
            <!-- Sección lateral -->
            <aside class="lateral">
                <h3>Últimas noticias en línea</h3>
                <?php
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
                
                <?php if ($usuario_logueado): ?>
                <div style="margin-top: 20px; padding: 10px; background-color: #f0f0f0; border-radius: 5px;">
                    <p>Bienvenido, <strong><?php echo $_SESSION['admin_nombre']; ?></strong></p>
                    <p><a href="logout.php" style="color: #800000;">Cerrar sesión</a></p>
                </div>
                <?php else: ?>
                <div style="margin-top: 20px; padding: 10px; background-color: #f0f0f0; border-radius: 5px;">
                    <p><a href="login.php" style="color: #800000;">Iniciar sesión</a></p>
                </div>
                <?php endif; ?>
            </aside>

            <!-- Contenido principal -->
            <main class="contenido">
                <h2>Insertar Nueva Noticia</h2>
                
                <?php if (!$usuario_logueado): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                    <p>Debe iniciar sesión como administrador para insertar noticias.</p>
                    <p><a href="login.php" style="color: #721c24; text-decoration: underline;">Iniciar sesión</a></p>
                </div>
                <?php else: ?>
                
                <?php
                // Procesar el formulario cuando se envía
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Obtener los datos del formulario
                    $titulo = $_POST['titulo'];
                    $id_categoria = $_POST['categoria'];
                    $contenido = $_POST['contenido'];
                    $autor = isset($_POST['autor']) ? $_POST['autor'] : 'Anónimo'; // Guardamos el nombre del autor
                    $id_autor = 1; // Asignamos un ID de autor predeterminado (por ejemplo, 1)
                    $destacada = isset($_POST['destacada']) ? 1 : 0;
                    
                    // Manejar la imagen si se ha subido
                    $ruta_imagen = '';
                    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                        $nombre_archivo = time() . '_' . $_FILES['imagen']['name'];
                        $ruta_destino = '../uploads/' . $nombre_archivo;
                        
                        // Verificar si el directorio existe, si no, crearlo
                        if (!file_exists('../uploads/')) {
                            mkdir('../uploads/', 0777, true);
                        }
                        
                        // Mover el archivo subido al directorio de destino
                        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino)) {
                            $ruta_imagen = '../uploads/' . $nombre_archivo;
                        }
                    }
                    
                    // Preparar la consulta SQL para insertar la noticia
                    $fecha_actual = date('Y-m-d H:i:s');
                    $sql = "INSERT INTO noticias (titulo, contenido, fecha_publicacion, id_categoria, imagen, destacada, id_autor) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)";
                    
                    // Preparar la sentencia
                    $stmt = $conexion->prepare($sql);
                    
                    // Verificar si la preparación fue exitosa
                    if ($stmt) {
                        // Vincular parámetros
                        $stmt->bind_param("sssisii", $titulo, $contenido, $fecha_actual, $id_categoria, $ruta_imagen, $destacada, $id_autor);
                        
                        // Ejecutar la consulta
                        if ($stmt->execute()) {
                            echo "<div style='background-color: #d4edda; color: #155724; padding: 15px; margin-bottom: 20px; border-radius: 5px;'>
                                    La noticia ha sido insertada correctamente.
                                  </div>";
                        } else {
                            echo "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;'>
                                    Error al insertar la noticia: " . $stmt->error . "
                                  </div>";
                        }
                        
                        // Cerrar la sentencia
                        $stmt->close();
                    } else {
                        echo "<div style='background-color: #f8d7da; color: #721c24; padding: 15px; margin-bottom: 20px; border-radius: 5px;'>
                                Error en la preparación de la consulta: " . $conexion->error . "
                              </div>";
                    }
                }
                ?>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data" style="background-color: #f9f9f9; padding: 20px; border-radius: 5px;">
                    <div style="margin-bottom: 15px;">
                        <label for="titulo">Título:</label><br>
                        <input type="text" id="titulo" name="titulo" required style="width: 100%; padding: 8px; margin-top: 5px;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="categoria">Categoría:</label><br>
                        <select id="categoria" name="categoria" required style="width: 100%; padding: 8px; margin-top: 5px;">
                            <option value="">Seleccione una categoría</option>
                            <?php
                            // Consulta para obtener todas las categorías
                            $sql = "SELECT id_categoria, nombre FROM categorias ORDER BY nombre";
                            $resultado = $conexion->query($sql);
                            
                            if ($resultado && $resultado->num_rows > 0) {
                                while ($categoria = $resultado->fetch_assoc()) {
                                    echo "<option value='" . $categoria['id_categoria'] . "'>" . $categoria['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="contenido">Contenido:</label><br>
                        <textarea id="contenido" name="contenido" rows="10" required style="width: 100%; padding: 8px; margin-top: 5px;"></textarea>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="imagen">Imagen:</label><br>
                        <input type="file" id="imagen" name="imagen" style="margin-top: 5px;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="destacada">¿Destacar noticia?</label>
                        <input type="checkbox" id="destacada" name="destacada" value="1">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="autor">Autor:</label><br>
                        <input type="text" id="autor" name="autor" style="width: 100%; padding: 8px; margin-top: 5px;">
                    </div>
                    
                    <div>
                        <input type="submit" value="Guardar Noticia" style="background-color: #800000; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                    </div>
                </form>
                <?php endif; ?>
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