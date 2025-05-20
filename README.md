# Sistema de Noticias Tacna
## Descripción del Proyecto
Este proyecto es un sistema CRUD (Crear, Leer, Actualizar, Eliminar) para la gestión de noticias desarrollado como parte del curso de Programación Web I. El sistema permite administrar noticias, categorías, usuarios y comentarios a través de una interfaz web intuitiva.

## Características Principales
- Gestión de Noticias : Crear, editar, eliminar y listar noticias
- Categorización : Organización de noticias por categorías
- Sistema de Usuarios : Diferentes roles (admin, editor, lector)
- Comentarios : Posibilidad de comentar en las noticias
- Noticias Destacadas : Visualización de noticias importantes en la página principal
- Formulario de Contacto : Sistema para recibir mensajes de los visitantes
- Búsqueda : Funcionalidad para buscar noticias específicas
## Tecnologías Utilizadas
- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
## Estructura de la Base de Datos
El sistema utiliza una base de datos MySQL con las siguientes tablas:

- categorias : Almacena las categorías de noticias
- usuarios : Gestiona los usuarios del sistema con diferentes roles
- noticias : Tabla principal que almacena todas las noticias
- comentarios : Almacena los comentarios realizados en las noticias
- contactos : Guarda los mensajes enviados a través del formulario de contacto
## Estructura del Proyecto
```
progra-web-1-crud/
├── BD.txt                  # Script SQL 
para crear la base de datos
├── css/                    # Hojas de 
estilo
│   └── estilos.css
├── images/                 # Imágenes del 
sistema
│   ├── banner.png
│   └── noticias/
├── includes/               # Archivos de 
inclusión
│   ├── config.php          # 
Configuración de rutas
│   ├── footer.php          # Pie de 
página común
│   ├── funciones.php       # Funciones 
reutilizables
│   └── header.php          # Encabezado 
común
├── index.php               # Página 
principal
├── js/                     # Scripts 
JavaScript
├── php/                    # Archivos de 
procesamiento PHP
│   ├── buscar.php          # Búsqueda de 
noticias
│   ├── conexion.php        # Conexión a 
la base de datos
│   ├── consultas.php       # Consultas 
especiales
│   ├── contacto.php        # Formulario 
de contacto
│   ├── editar_noticia.php  # Edición de 
noticias
│   ├── eliminar_noticia.php # Eliminación 
de noticias
│   ├── insertar_noticia.php # Inserción 
de noticias
│   ├── listar_noticias.php # Listado de 
noticias
│   ├── procesar_editar.php # 
Procesamiento de edición
│   ├── procesar_eliminar.php # 
Procesamiento de eliminación
│   └── ver_noticia.php     # 
Visualización de noticia individual
└── uploads/                # Carpeta para 
imágenes subidas
```
## Instalación
### Requisitos Previos
- Servidor web (Apache recomendado)
- PHP 7.0 o superior
- MySQL 5.7 o superior
### Pasos de Instalación
1. Clone o descargue este repositorio en su directorio web (ej. htdocs en XAMPP)
2. Cree una base de datos MySQL llamada noticias_tacna
3. Importe el archivo BD.txt para crear las tablas necesarias:
   ```
   mysql -u usuario -p noticias_tacna < BD.
   txt
   ``` O utilice phpMyAdmin para importar el archivo
4. Configure los parámetros de conexión a la base de datos en php/conexion.php
5. Acceda al sistema a través de su navegador: http://localhost/progra-web-1-crud/
## Uso del Sistema
- Página Principal : Muestra las noticias destacadas
- Insertar Noticias : Permite crear nuevas noticias con título, contenido, categoría, autor e imagen
- Editar Noticias : Modifica noticias existentes
- Eliminar Noticias : Elimina noticias del sistema
- Listar Noticias : Muestra todas las noticias con opciones de filtrado
- Buscar : Permite buscar noticias por título, contenido o categoría
- Consultas : Ofrece consultas predefinidas sobre las noticias
- Contacto : Formulario para enviar mensajes al administrador
## Licencia
Este proyecto está licenciado bajo la Licencia Pública General de GNU v3.0 - vea el archivo LICENSE para más detalles.

## Autor
Desarrollado para el curso de Programación Web I 2024-II Tacna.

## Contribuciones
Las contribuciones son bienvenidas. Por favor, asegúrese de seguir las convenciones de código existentes.