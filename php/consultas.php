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
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
            </aside>

            <!-- Contenido principal -->
            <main class="contenido">
                <h2>Consultas Estadísticas</h2>
                
                <!-- Selector de consultas -->
                <div style="margin-bottom: 20px;">
                    <form action="consultas.php" method="get">
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <label for="tipo_consulta">Seleccione tipo de consulta:</label>
                            <select id="tipo_consulta" name="tipo_consulta" style="padding: 8px;">
                                <option value="categoria">Noticias por categoría</option>
                                <option value="autor">Noticias por autor</option>
                                <option value="fecha">Noticias por fecha</option>
                                <option value="popular">Noticias más populares</option>
                            </select>
                            <input type="submit" value="Generar" style="background-color: #800000; color: white; padding: 8px 15px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
                
                <!-- Resultados de consulta (simulados) -->
                <div style="margin-bottom: 30px;">
                    <h3 style="margin-bottom: 15px; color: #800000;">Noticias por Categoría</h3>
                    
                    <!-- Gráfico simulado -->
                    <div style="margin-bottom: 20px; background-color: #f9f9f9; padding: 15px; border: 1px solid #ddd;">
                        <div style="height: 300px; display: flex; align-items: flex-end; justify-content: space-around; padding: 10px 0;">
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <div style="width: 60px; background-color: #800000; height: 150px;"></div>
                                <p style="margin-top: 10px;">Política</p>
                                <p style="font-weight: bold;">15</p>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <div style="width: 60px; background-color: #800000; height: 200px;"></div>
                                <p style="margin-top: 10px;">Deportes</p>
                                <p style="font-weight: bold;">20</p>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <div style="width: 60px; background-color: #800000; height: 100px;"></div>
                                <p style="margin-top: 10px;">Tecnología</p>
                                <p style="font-weight: bold;">10</p>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center;">
                                <div style="width: 60px; background-color: #800000; height: 120px;"></div>
                                <p style="margin-top: 10px;">Cultura</p>
                                <p style="font-weight: bold;">12</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tabla de datos -->
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background-color: #f0f0f0;">
                                <th style="padding: 10px; text-align: left; border: 1px solid #ddd;">Categoría</th>
                                <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">Cantidad</th>
                                <th style="padding: 10px; text-align: center; border: 1px solid #ddd;">Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">Política</td>
                                <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">15</td>
                                <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">26.3%</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">Deportes</td>
                                <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">20</td>
                                <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">35.1%</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">Tecnología</td>
                                <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">10</td>
                                <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">17.5%</td>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;">Cultura</td>
                                <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">12</td>
                                <td style="padding: 10px; text-align: center; border: 1px solid #ddd;">21.1%</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr style="background-color: #f0f0f0;">
                                <td style="padding: 10px; font-weight: bold; border: 1px solid #ddd;">Total</td>
                                <td style="padding: 10px; text-align: center; font-weight: bold; border: 1px solid #ddd;">57</td>
                                <td style="padding: 10px; text-align: center; font-weight: bold; border: 1px solid #ddd;">100%</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <!-- Opciones de exportación -->
                <div style="text-align: right; margin-top: 20px;">
                    <a href="#" style="background-color: #800000; color: white; padding: 8px 15px; text-decoration: none; margin-left: 10px;">Exportar a PDF</a>
                    <a href="#" style="background-color: #800000; color: white; padding: 8px 15px; text-decoration: none; margin-left: 10px;">Exportar a Excel</a>
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