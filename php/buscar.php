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
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
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
                            <input type="text" id="termino" name="termino" style="width: 100%; padding: 8px; margin-top: 5px;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="categoria">Categoría:</label><br>
                            <select id="categoria" name="categoria" style="width: 100%; padding: 8px; margin-top: 5px;">
                                <option value="">Todas las categorías</option>
                                <option value="politica">Política</option>
                                <option value="deportes">Deportes</option>
                                <option value="tecnologia">Tecnología</option>
                                <option value="cultura">Cultura</option>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="fecha_desde">Desde fecha:</label><br>
                            <input type="date" id="fecha_desde" name="fecha_desde" style="width: 100%; padding: 8px; margin-top: 5px;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="fecha_hasta">Hasta fecha:</label><br>
                            <input type="date" id="fecha_hasta" name="fecha_hasta" style="width: 100%; padding: 8px; margin-top: 5px;">
                        </div>
                        
                        <div>
                            <input type="submit" value="Buscar" style="background-color: #800000; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
                
                <!-- Resultados de búsqueda (simulados) -->
                <h3 style="margin-bottom: 15px;">Resultados de la búsqueda</h3>
                
                <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 15px;">
                    <h3 style="color: #800000; margin-bottom: 5px;">Ejemplo de noticia 1</h3>
                    <p style="color: #666; font-size: 12px; margin-bottom: 10px;">Categoría: Política | Fecha: 2024-05-15 | Autor: Juan Pérez</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl.</p>
                    <a href="ver_noticia.php?id=1" style="color: #800000; text-decoration: none; display: inline-block; margin-top: 10px;">Leer más...</a>
                </div>
                
                <div style="margin-bottom: 20px; border: 1px solid #ddd; padding: 15px;">
                    <h3 style="color: #800000; margin-bottom: 5px;">Ejemplo de noticia 2</h3>
                    <p style="color: #666; font-size: 12px; margin-bottom: 10px;">Categoría: Deportes | Fecha: 2024-05-14 | Autor: María López</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl.</p>
                    <a href="ver_noticia.php?id=2" style="color: #800000; text-decoration: none; display: inline-block; margin-top: 10px;">Leer más...</a>
                </div>
                
                <!-- Paginación -->
                <div style="text-align: center; margin-top: 20px;">
                    <a href="#" style="padding: 5px 10px; margin: 0 5px; border: 1px solid #ddd; text-decoration: none; color: #800000;">1</a>
                    <a href="#" style="padding: 5px 10px; margin: 0 5px; border: 1px solid #ddd; text-decoration: none; color: #800000;">2</a>
                    <a href="#" style="padding: 5px 10px; margin: 0 5px; border: 1px solid #ddd; text-decoration: none; color: #800000;">3</a>
                    <a href="#" style="padding: 5px 10px; margin: 0 5px; border: 1px solid #ddd; text-decoration: none; color: #800000;">Siguiente »</a>
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