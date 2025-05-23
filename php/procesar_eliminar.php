<?php
// Incluir archivo de conexión
require_once 'conexion.php';

// Verificar si se recibió el ID de la noticia
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Obtener y sanitizar el ID de la noticia
    $id_noticia = $conexion->real_escape_string($_GET['id']);
    
    // Primero, verificar si la noticia existe
    $sql_verificar = "SELECT id_noticia, imagen FROM noticias WHERE id_noticia = '$id_noticia'";
    $resultado = $conexion->query($sql_verificar);
    
    // Incluir funciones FTP
    require_once '../includes/funciones.php';
    
    if ($resultado && $resultado->num_rows > 0) {
        $noticia = $resultado->fetch_assoc();
        
        // Eliminar la imagen asociada si existe
        if (!empty($noticia['imagen'])) {
            eliminar_archivo_ftp($noticia['imagen']);
        }
        
        // Eliminar la noticia de la base de datos
        $sql_eliminar = "DELETE FROM noticias WHERE id_noticia = '$id_noticia'";
        
        if ($conexion->query($sql_eliminar) === TRUE) {
            // Redirigir a la página de eliminar con mensaje de éxito
            header("Location: eliminar_noticia.php?eliminado=true");
            exit;
        } else {
            // Si hay un error en la eliminación
            header("Location: eliminar_noticia.php?error=true&mensaje=" . urlencode("Error al eliminar la noticia: " . $conexion->error));
            exit;
        }
    } else {
        // Si la noticia no existe
        header("Location: eliminar_noticia.php?error=true&mensaje=" . urlencode("La noticia no existe"));
        exit;
    }
} else {
    // Si no se proporcionó un ID válido
    header("Location: eliminar_noticia.php?error=true&mensaje=" . urlencode("ID de noticia no válido"));
    exit;
}
?>