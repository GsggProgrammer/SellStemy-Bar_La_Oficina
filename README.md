# 🍻 Sistema de Información Web - Bar - *La Oficina*

Este proyecto corresponde a un **sistema de información orientado a la web** para la gestión integral de un bar llamado *La Oficina*.  
El sistema fue desarrollado siguiendo la metodología **RUP** y está diseñado con arquitectura **MVC** (Modelo–Vista–Controlador).
Es un sistema cerrado, unicamente personas pertenecientes a la empresa y con un rol en el sistema pueden acceder a el

---

## 📋 Funcionalidades principales

- **Gestión de usuarios** con roles y permisos específicos:
  - 👨‍💼 Administrador → Acceso completo al sistema.
  - 💰 Cajero → Registro de ventas y gestión de clientes.
  - 📦 Almacenista → Control de inventario y proveedores.

- **Módulos incluidos**:
  - 👥 Módulo de usuarios
  - 🛒 Módulo de productos e inventario
  - 🏢 Módulo de proveedores
  - 💵 Módulo de ventas
  - 📊 Reportes:
    - Ventas por empleado
    - Ventas por producto

---

## 📂 Estructura del repositorio

- RUP
  - modelo/ # Entidades y lógica de negocio (PHP, MySQL)
  - controlador/ # Controladores (PHP)
  - vista/ # Interfaces de usuario (HTML, JS, PHP, etc.)
  - estilos/ # Hojas de estilo (CSS)
  - proyecto.sql # Script SQL con tablas y datos iniciales

  - docs/ # Documentación y diagramas
    - casos_de_uso.png
    - diagrama_clases.png
    - diagrama_relacional.png
    - modelo_entidad_relacion.png
    - diccionario_datos.md
    - presupuesto.md

  - README.md # Guía principal del proyecto
  - .gitattributes # Archivos a ignorar
  - cerrarSesion.php # Archivo para manejo de sesiones
  - estilos.css # Estilos generales de todas las paginas del sistema
  - vistaPrincipal.php # Pagina principal del sistema
  - LogoGpt.jpg # Logo principal de la empresa cliente (Bar - La Oficina)

  # Pagina web de la empresa desarrolladora del sistema ()
  - SELLSTEMY.html
  - SELLSTEMYEST.css

## 🚀 Instalación y ejecución

1. **Clonar el repositorio**:
   - ```bash
   - git clone https://github.com/tuusuario/RUP.git
   - En "tuusuario" debes ingresar tu nombre de usuario de GitHub

2. Configurar la base de datos:
   - Importar el archivo proyecto.sql en tu gestor MySQL/MariaDB.
   - Ejecutar todo el codigo del archivo proyecto.sql
   - Verificar que la base de datos ha sido creada con los registros iniciales

3. Levantar el servidor local:
   - Usar XAMPP como servidor web PHP (Si no lo tienes descargado, ingresa aqui https://www.apachefriends.org/es/download.html y selecciona la ultima version)
   - Configurar descarga de XAMPP
   - Ejecutar XAMPP Control Panel
   - Iniciar el servicio de Apache y MySql
   - Copiar toda la carpeta del proyecto (RUP) en htdocs ("C:\xampp\htdocs" por defecto sin hacer cambios en el PATH)

4. Acceder al sistema:
   - Abrir en el navegador: http://localhost/RUP
   - Ingresar al archivo http://localhost/RUP/vista/VLogin.html

5. Acceder como tipo de usuario en especifico

   - Tipo Administrador
     - Nombre de usuario: 1147484267
     - Contraseña: GSGG_ADMIN

   - Tipo Almacenista
     - Nombre de usuario: 1147484264
     - Contraseña: LPGG_ADMIN

   - Tipo Cajero
     - Nombre de usuario: 1147484261
     - Contraseña: MG_ADMIN

👤 Roles de usuario y permisos
A todos los usuarios se les verifica credenciales mediante un nombre de usuario que es su numero de documento y una contraseña pre-asignada

1. Administrador
   - Gestiona usuarios, proveedores, productos e inventario.
   - Accede a todos los reportes y toma desiciones.

2. Cajero
   - Gestiona ventas.
   - Consulta Productos.
   - Consulta Perfil Propio

3. Almacenista
   - Administra productos (inventario).
   - Gestiona proveedores.
   - Consulta Perfil Propio

📊 Diagramas disponibles
   - 📌 Casos de uso
   - 📌 Diagrama de clases
   - 📌 Diagrama entidad-relación
   - 📌 Diagrama relacional
Todos disponibles en la carpeta docs/diagramas.

⚙️ Requisitos del sistema
   - Lenguaje: PHP >= 8.0
   - Base de datos: MySQL/MariaDB >= 5.7
   - Servidor web: Apache/Nginx
   - Navegador web actualizado

📝 Notas adicionales
   - Este proyecto fue desarrollado como parte de un sistema de información empresarial orientado al sector de bares y restaurantes, en colaboración con el cliente Bar - La Oficina.
   - La organización de carpetas sigue la metodología RUP y la arquitectura MVC para facilitar su escalabilidad y mantenimiento.
