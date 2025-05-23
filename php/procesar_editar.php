<?php
// Incluir archivo de conexión
require_once 'conexion.php';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario
    $id_noticia = $conexion->real_escape_string($_POST['id_noticia']);
    $titulo = $conexion->real_escape_string($_POST['titulo']);
    $id_categoria = $conexion->real_escape_string($_POST['id_categoria']);
    $contenido = $conexion->real_escape_string($_POST['contenido']);
    $id_autor = $conexion->real_escape_string($_POST['id_autor']);
    $destacada = isset($_POST['destacada']) ? 1 : 0;
    $imagen_actual = $conexion->real_escape_string($_POST['imagen_actual']);
    
    // Incluir funciones FTP
    require_once '../includes/funciones.php';
    
    // Manejar la imagen si se subió una nueva
    $imagen = $imagen_actual; // Por defecto, mantener la imagen actual
    
    if (isset($_FILES['nueva_imagen']) && $_FILES['nueva_imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_temporal = $_FILES['nueva_imagen']['tmp_name'];
        $nombre_archivo = uniqid() . '_' . $_FILES['nueva_imagen']['name'];
        
        // Subir la nueva imagen al servidor FTP
        $subida_exitosa = subir_archivo_ftp($nombre_temporal, $nombre_archivo);
        
        if ($subida_exitosa) {
            // Si se subió correctamente, actualizar el nombre de la imagen
            $imagen = $nombre_archivo;
            
            // Eliminar la imagen anterior si existe
            if (!empty($imagen_actual)) {
                eliminar_archivo_ftp($imagen_actual);
            }
        }
    }
    
    // Actualizar la noticia en la base de datos
    $sql = "UPDATE noticias SET 
            titulo = '$titulo', 
            id_categoria = '$id_categoria', 
            contenido = '$contenido', 
            id_autor = '$id_autor', 
            destacada = $destacada, 
            imagen = '$imagen', 
            fecha_publicacion = NOW() 
            WHERE id_noticia = '$id_noticia'";
    
    if ($conexion->query($sql) === TRUE) {
        // Redirigir a la página de edición con mensaje de éxito
        header("Location: formulario_editar.php?id=$id_noticia&actualizado=true");
        exit;
    } else {
        // Si hay un error, mostrar mensaje
        echo "Error al actualizar la noticia: " . $conexion->error;
        echo "<br><a href='formulario_editar.php?id=$id_noticia'>Volver al formulario</a>";
    }
} else {
    // Si no se envió el formulario por POST, redirigir a la página de edición
    header("Location: editar_noticia.php");
    exit;
}

// Cerrar la conexión
$conexion->close();
?>