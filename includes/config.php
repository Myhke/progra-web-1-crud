<?php
// Detectar si estamos en el directorio raíz o en un subdirectorio
$en_directorio_raiz = !strpos($_SERVER['PHP_SELF'], '/php/');

// Configurar rutas base según la ubicación
if ($en_directorio_raiz) {
    // Estamos en el directorio raíz
    $ruta_base = '';
    $ruta_css = 'css/estilos.css';
    $ruta_js = 'js/scripts.js';
    $ruta_banner = 'images/banner.png';
    $ruta_index = 'index.php';
} else {
    // Estamos en un subdirectorio (php/)
    $ruta_base = '../';
    $ruta_css = '../css/estilos.css';
    $ruta_js = '../js/scripts.js';
    $ruta_banner = '../images/banner.png';
    $ruta_index = '../index.php';
}
?>