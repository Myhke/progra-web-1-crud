<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - Sistema de Noticias Tacna</title>
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
                <h2>Contacto</h2>
                
                <!-- Información de contacto -->
                <div style="margin-bottom: 30px;">
                    <h3 style="color: #800000; margin-bottom: 15px;">Información de Contacto</h3>
                    <p style="margin-bottom: 10px;"><strong>Dirección:</strong> Av. Bolognesi 1234, Tacna, Perú</p>
                    <p style="margin-bottom: 10px;"><strong>Teléfono:</strong> (052) 123-4567</p>
                    <p style="margin-bottom: 10px;"><strong>Email:</strong> contacto@noticiastacna.com</p>
                    <p style="margin-bottom: 20px;"><strong>Horario de atención:</strong> Lunes a Viernes de 8:00 am a 6:00 pm</p>
                    
                    <!-- Mapa simulado -->
                    <div style="width: 100%; height: 300px; background-color: #f0f0f0; display: flex; justify-content: center; align-items: center; margin-bottom: 20px; border: 1px solid #ddd;">
                        <p>Mapa de ubicación</p>
                    </div>
                </div>
                
                <!-- Formulario de contacto -->
                <div style="margin-bottom: 30px;">
                    <h3 style="color: #800000; margin-bottom: 15px;">Envíenos un mensaje</h3>
                    <form action="procesar_contacto.php" method="post">
                        <div style="margin-bottom: 15px;">
                            <label for="nombre">Nombre completo:</label><br>
                            <input type="text" id="nombre" name="nombre" style="width: 100%; padding: 8px; margin-top: 5px;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="email">Correo electrónico:</label><br>
                            <input type="email" id="email" name="email" style="width: 100%; padding: 8px; margin-top: 5px;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="asunto">Asunto:</label><br>
                            <input type="text" id="asunto" name="asunto" style="width: 100%; padding: 8px; margin-top: 5px;">
                        </div>
                        
                        <div style="margin-bottom: 15px;">
                            <label for="mensaje">Mensaje:</label><br>
                            <textarea id="mensaje" name="mensaje" rows="6" style="width: 100%; padding: 8px; margin-top: 5px;"></textarea>
                        </div>
                        
                        <div>
                            <input type="submit" value="Enviar Mensaje" style="background-color: #800000; color: white; padding: 10px 15px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
                
                <!-- Redes sociales -->
                <div>
                    <h3 style="color: #800000; margin-bottom: 15px;">Síguenos en redes sociales</h3>
                    <div style="display: flex; gap: 15px;">
                        <a href="#" style="text-decoration: none; color: #333;">
                            <div style="width: 40px; height: 40px; background-color: #3b5998; color: white; display: flex; justify-content: center; align-items: center; border-radius: 50%;">F</div>
                        </a>
                        <a href="#" style="text-decoration: none; color: #333;">
                            <div style="width: 40px; height: 40px; background-color: #1da1f2; color: white; display: flex; justify-content: center; align-items: center; border-radius: 50%;">T</div>
                        </a>
                        <a href="#" style="text-decoration: none; color: #333;">
                            <div style="width: 40px; height: 40px; background-color: #c32aa3; color: white; display: flex; justify-content: center; align-items: center; border-radius: 50%;">I</div>
                        </a>
                        <a href="#" style="text-decoration: none; color: #333;">
                            <div style="width: 40px; height: 40px; background-color: #ff0000; color: white; display: flex; justify-content: center; align-items: center; border-radius: 50%;">Y</div>
                        </a>
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