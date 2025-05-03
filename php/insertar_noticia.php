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
                <h2>Insertar Nueva Noticia</h2>
                <form action="procesar_insertar.php" method="post">
                    <div style="margin-bottom: 15px;">
                        <label for="titulo">Título:</label><br>
                        <input type="text" id="titulo" name="titulo" style="width: 100%; padding: 8px; margin-top: 5px;">
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="contenido">Contenido:</label><br>
                        <textarea id="contenido" name="contenido" rows="10" style="width: 100%; padding: 8px; margin-top: 5px;"></textarea>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="categoria">Categoría:</label><br>
                        <select id="categoria" name="categoria" style="width: 100%; padding: 8px; margin-top: 5px;">
                            <option value="politica">Política</option>
                            <option value="deportes">Deportes</option>
                            <option value="tecnologia">Tecnología</option>
                            <option value="cultura">Cultura</option>
                        </select>
                    </div>
                    
                    <div style="margin-bottom: 15px;">
                        <label for="autor">Autor:</label><br>
                        <input type="text" id="autor" name="autor" style="width: 100%; padding: 8px; margin-top: 5px;">
                    </div>
                    
                    <div>
                        <input type="submit" value="Guardar Noticia" style="background-color: #800000; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                    </div>
                </form>
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