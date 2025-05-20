<?php
// Incluir archivo de configuración
require_once '../includes/config.php';

// Definir título de la página
$titulo_pagina = 'Consultas - Sistema de Noticias Tacna';

// Incluir el encabezado
include '../includes/header.php';
?>

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
    
    <div style="display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 30px;">
        <!-- Consulta 1: Noticias por categoría -->
        <div style="flex: 1; min-width: 300px; background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
            <h3 style="color: #800000; margin-top: 0;">Noticias por Categoría</h3>
            <?php
            $sql_categorias = "SELECT c.nombre, COUNT(n.id_noticia) as total
                              FROM categorias c
                              LEFT JOIN noticias n ON c.id_categoria = n.id_categoria
                              GROUP BY c.id_categoria
                              ORDER BY total DESC";
            $resultado_categorias = $conexion->query($sql_categorias);
            
            if ($resultado_categorias && $resultado_categorias->num_rows > 0) {
                echo "<table style='width: 100%; border-collapse: collapse;'>";
                echo "<tr style='background-color: #800000; color: white;'>";
                echo "<th style='padding: 8px; text-align: left;'>Categoría</th>";
                echo "<th style='padding: 8px; text-align: right;'>Cantidad</th>";
                echo "</tr>";
                
                $fila_color = true;
                while ($fila = $resultado_categorias->fetch_assoc()) {
                    $bg_color = $fila_color ? '#f2f2f2' : 'white';
                    echo "<tr style='background-color: $bg_color;'>";
                    echo "<td style='padding: 8px;'>" . $fila['nombre'] . "</td>";
                    echo "<td style='padding: 8px; text-align: right;'>" . $fila['total'] . "</td>";
                    echo "</tr>";
                    $fila_color = !$fila_color;
                }
                
                echo "</table>";
            } else {
                echo "<p>No hay datos disponibles.</p>";
            }
            ?>
        </div>
        
        <!-- Consulta 2: Noticias por mes -->
        <div style="flex: 1; min-width: 300px; background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
            <h3 style="color: #800000; margin-top: 0;">Noticias por Mes (2024)</h3>
            <?php
            $sql_meses = "SELECT MONTH(fecha_publicacion) as mes, COUNT(*) as total
                         FROM noticias
                         WHERE YEAR(fecha_publicacion) = 2024
                         GROUP BY MONTH(fecha_publicacion)
                         ORDER BY mes";
            $resultado_meses = $conexion->query($sql_meses);
            
            if ($resultado_meses && $resultado_meses->num_rows > 0) {
                $meses = array(
                    1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
                    5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
                    9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
                );
                
                echo "<table style='width: 100%; border-collapse: collapse;'>";
                echo "<tr style='background-color: #800000; color: white;'>";
                echo "<th style='padding: 8px; text-align: left;'>Mes</th>";
                echo "<th style='padding: 8px; text-align: right;'>Cantidad</th>";
                echo "</tr>";
                
                $fila_color = true;
                while ($fila = $resultado_meses->fetch_assoc()) {
                    $bg_color = $fila_color ? '#f2f2f2' : 'white';
                    echo "<tr style='background-color: $bg_color;'>";
                    echo "<td style='padding: 8px;'>" . $meses[$fila['mes']] . "</td>";
                    echo "<td style='padding: 8px; text-align: right;'>" . $fila['total'] . "</td>";
                    echo "</tr>";
                    $fila_color = !$fila_color;
                }
                
                echo "</table>";
            } else {
                echo "<p>No hay datos disponibles para 2024.</p>";
            }
            ?>
        </div>
    </div>
    
    <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        <!-- Consulta 3: Autores más activos -->
        <div style="flex: 1; min-width: 300px; background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
            <h3 style="color: #800000; margin-top: 0;">Autores más Activos</h3>
            <?php
            $sql_autores = "SELECT u.nombre, COUNT(n.id_noticia) as total
                           FROM usuarios u
                           LEFT JOIN noticias n ON u.id_usuario = n.id_autor
                           GROUP BY u.id_usuario
                           ORDER BY total DESC
                           LIMIT 5";
            $resultado_autores = $conexion->query($sql_autores);
            
            if ($resultado_autores && $resultado_autores->num_rows > 0) {
                echo "<table style='width: 100%; border-collapse: collapse;'>";
                echo "<tr style='background-color: #800000; color: white;'>";
                echo "<th style='padding: 8px; text-align: left;'>Autor</th>";
                echo "<th style='padding: 8px; text-align: right;'>Noticias</th>";
                echo "</tr>";
                
                $fila_color = true;
                while ($fila = $resultado_autores->fetch_assoc()) {
                    $bg_color = $fila_color ? '#f2f2f2' : 'white';
                    echo "<tr style='background-color: $bg_color;'>";
                    echo "<td style='padding: 8px;'>" . $fila['nombre'] . "</td>";
                    echo "<td style='padding: 8px; text-align: right;'>" . $fila['total'] . "</td>";
                    echo "</tr>";
                    $fila_color = !$fila_color;
                }
                
                echo "</table>";
            } else {
                echo "<p>No hay datos disponibles.</p>";
            }
            ?>
        </div>
        
        <!-- Consulta 4: Noticias destacadas -->
        <div style="flex: 1; min-width: 300px; background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
            <h3 style="color: #800000; margin-top: 0;">Noticias Destacadas</h3>
            <?php
            $sql_destacadas = "SELECT COUNT(*) as total FROM noticias WHERE destacada = 1";
            $resultado_destacadas = $conexion->query($sql_destacadas);
            
            if ($resultado_destacadas) {
                $fila = $resultado_destacadas->fetch_assoc();
                echo "<div style='text-align: center; padding: 20px;'>";
                echo "<span style='font-size: 48px; color: #800000;'>" . $fila['total'] . "</span>";
                echo "<p>noticias destacadas en el sistema</p>";
                echo "</div>";
            } else {
                echo "<p>No hay datos disponibles.</p>";
            }
            ?>
        </div>
    </div>
</main>

<?php
// Incluir el pie de página
include '../includes/footer.php';
?>