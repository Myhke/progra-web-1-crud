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
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            </aside>

            <!-- Contenido principal -->
            <main class="contenido">
                <h2>Contenido principal</h2>
                <!-- Aquí irá el contenido dinámico según la sección -->
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