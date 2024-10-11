# Proyecto de Contacto en Symfony

Este proyecto es una aplicación de contacto desarrollada con Symfony, que permite a los usuarios enviar mensajes a través de un formulario y gestionar áreas de contacto. También incluye una funcionalidad adicional para verificar si un punto (longitud, latitud) se encuentra dentro de un polígono de cobertura almacenado en la base de datos.

## Tabla de Contenidos

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Configuración de la Base de Datos](#configuración-de-la-base-de-datos)
- [Rutas](#rutas)
  - [Crear Nueva Área de Contacto](#1-crear-nueva-área-de-contacto)
  - [Enviar Mensaje de Contacto](#2-enviar-mensaje-de-contacto)
  - [Verificar Punto en Polígono de Cobertura](#3-verificar-punto-en-polígono-de-cobertura)
  - [Insertar Polígono de Cobertura (Bonus)](#4-insertar-polígono-de-cobertura-bonus)
- [Contribuciones](#contribuciones)
- [Licencia](#licencia)

## Requisitos

- PHP 8.0 o superior
- Symfony 6.0 o superior
- MySQL (usando XAMPP)
- Composer

## Instalación

1. Clona este repositorio en tu máquina local:

   ```bash
   git clone https://github.com/Cxrkeyb/test-iridian.git
   ```

2. Navega al directorio del proyecto:

   ```bash
   cd test-iridian
   ```

3. Instala las dependencias:

   ```bash
   composer install
   ```

4. Configura tu base de datos en el archivo `.env`:

   ```dotenv
   DATABASE_URL="mysql://usuario:contraseña@localhost:3306/nombre_base_datos"
   ```

5. Ejecuta las migraciones necesarias para crear las tablas en la base de datos:

   ```bash
   php bin/console doctrine:migrations:migrate
   ```

6. Inicia el servidor de desarrollo:

   ```bash
   symfony server:start
   ```

## Rutas

### 1. Crear Nueva Área de Contacto

- **Ruta:** `/nueva-area-contacto`
- **Método:** `GET` y `POST`
- **Descripción:** Permite crear una nueva área de contacto. Se presenta un formulario para ingresar el nombre y otros detalles del área de contacto. Si el formulario es válido, se guarda en la base de datos.

### 2. Enviar Mensaje de Contacto

- **Ruta:** `/contact`
- **Método:** `GET` y `POST`
- **Descripción:** Muestra un formulario de contacto con los siguientes campos:
  - Nombre
  - Apellido
  - Correo
  - Celular
  - Área de contacto (seleccionada a partir de las áreas disponibles)
  - Mensaje

  Se valida que el usuario (correo) no haya enviado más de un mensaje en el mismo día. Si el mensaje se envía correctamente, se almacena en la base de datos.

### 3. Verificar Punto en Polígono de Cobertura

- **Ruta:** `/verificar-punto/{lat}/{long}`
- **Método:** `GET`
- **Descripción:** Verifica si un punto específico (definido por sus coordenadas de latitud y longitud) está contenido dentro de un polígono de cobertura almacenado en la base de datos. Retorna un JSON indicando si el punto está dentro del área.

### 4. Insertar Polígono de Cobertura (Bonus)

- **Ruta:** `/insertar-poligono`
- **Método:** `POST`
- **Descripción:** Permite insertar un polígono de cobertura en la base de datos. El polígono se define como un `POLYGON` en formato WKT (Well-Known Text). Esta funcionalidad es un bonus para probar la verificación de puntos.