# 📘 Sistema de Inscripción Cursos

El Sistema de Inscripción Cursos es una aplicación web en PHP que permite inscribir usuarios en cursos y baremarlos según sus características. Utiliza la API PDO para interactuar con una base de datos MySQL de manera segura y eficiente. Guarda en la base de datos a administradores y candidatos a cursos. Además, se envían correos a través de la librería PHPMailer y se generan PDFs confirmatorios del curso asignado mediante la librería FPDF.

# 🛠️ Tecnologías Utilizadas

💻 Lenguaje de Programación: PHP<br>
💾 Base de Datos: MySQL<br>
🔄 Interacción con Base de Datos: API PDO<br>
📧 Envío de Correos: PHPMailer<br>
📄 Generación de PDFs: FPDF<br>

# 🚀 Funcionalidades

📝 Inscripción de Usuarios: Permite a los usuarios registrarse en cursos.<br>
📊 Baremación de Usuarios: Clasificación de usuarios según sus características.<br>
👤 Gestión de Administradores y Candidatos: Almacenamiento de información de administradores y candidatos en la base de datos.<br>
📧 Envío de Correos Electrónicos: Notificaciones y confirmaciones de inscripción enviadas por email.<br>
📄 Generación de PDFs: Creación de documentos PDF confirmatorios de la inscripción en cursos.<br>

# 📂 Instrucciones
- 📂 **Importar la Base de Datos MySQL**

**Crear Base de Datos:**
Abre MySQL Workbench o cualquier otra herramienta de administración de MySQL.
**Importar Script SQL:**
Ve a File > Open SQL Script y selecciona el archivo .sql proporcionado.
Ejecuta el script para crear y poblar las tablas necesarias (Administradores, Candidatos, etc.).

- 🖥️ **Configurar el Entorno**
  
**Configurar Archivo de Conexión a Base de Datos:**
En el archivo de configuración, actualiza las credenciales de acceso a la base de datos MySQL.
**Configurar PHPMailer:**
Configura los parámetros de la librería PHPMailer con las credenciales y servidores de correo.
**Configurar FPDF:**
Asegúrate de que la librería FPDF esté incluida en el proyecto para la generación de PDFs.

- 🧩 **Ejecutar la Aplicación**

**Subir Archivos al Servidor:**
Sube todos los archivos del proyecto a tu servidor web.
**Acceder a la Aplicación:**
Abre tu navegador web y ve a la URL donde se encuentra desplegada la aplicación para comenzar a usarla.

- 🛡️ **Seguridad**

🔒 Cifrado de Contraseñas: Almacenamiento de contraseñas cifradas en la base de datos. <br>
🔐 Protección de Datos: Validación y sanitización de entradas para prevenir inyecciones SQL y otros ataques.<br>
