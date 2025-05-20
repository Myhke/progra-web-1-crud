<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($titulo_pagina) ? $titulo_pagina : 'Sistema de Noticias Tacna'; ?></title>
    <link rel="stylesheet" href="<?php echo $ruta_base; ?>css/estilos.css">
</head>
<body>
    <div class="contenedor">
        <!-- Encabezado -->
        <header class="encabezado">
            <img src="<?php echo $ruta_base; ?>images/banner.png" alt="Banner Sistema de Noticias Tacna">
        </header>

        <!-- Barra de menú -->
        <nav class="barra-menu">
            <ul>
                <li><a href="<?php echo $ruta_base; ?>index.php">|   Inicio  |</a></li>
                <?php
                // Incluir opciones de administración solo si el usuario está logueado
                if (function_exists('es_admin_logueado') && es_admin_logueado()): 
                ?>
                <li><a href="<?php echo $ruta_base; ?>php/insertar_noticia.php">|    Insertar Noticias    |</a></li>
                <li><a href="<?php echo $ruta_base; ?>php/editar_noticia.php">|  Editar Noticias    |</a></li>
                <li><a href="<?php echo $ruta_base; ?>php/eliminar_noticia.php">|    Eliminar Noticias    |</a></li>
                <?php endif; ?>
                <li><a href="<?php echo $ruta_base; ?>php/listar_noticias.php">| Listar Noticias   |</a></li>
                <li><a href="<?php echo $ruta_base; ?>php/buscar.php">|  Buscar |</a></li>
                <?php if (function_exists('es_admin_logueado') && es_admin_logueado()): ?>
                <li><a href="<?php echo $ruta_base; ?>php/consultas.php">|   Consultas   |</a></li>
                <?php endif; ?>
                <li><a href="<?php echo $ruta_base; ?>php/contacto.php">|    Contacto |</a></li>
                <?php if (function_exists('es_admin_logueado')): ?>
                    <?php if (es_admin_logueado()): ?>
                    <li><a href="<?php echo $ruta_base; ?>php/logout.php">|   Cerrar Sesión   |</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>

        <div class="contenido-principal">