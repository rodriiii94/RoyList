# Manual de Administrador – RoyList

Este manual explica cómo poner en marcha el entorno de desarrollo y producción de **RoyList**, incluyendo el backend en Laravel, el microservicio Node.js y la base de datos MySQL.

## 1. Requisitos del sistema

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- Git  
- PHP 8.2 o superior  
- Composer  
- Laravel 10 o superior  
- Node.js 16+ y npm  
- MySQL 8 (o MariaDB compatible)  

<div class="page-break"></div>

## 2. Clonar el repositorio

Abre una terminal y ejecuta los siguientes comandos:

```bash
git clone https://github.com/rodriiii94/RoyList.git
cd RoyList
````

## 3. Configurar Laravel

### 3.1 Instalar dependencias PHP

```bash
composer install
```

### 3.2 Copiar y configurar el archivo de entorno

```bash
cp .env.example .env
```

Edita `.env` para configurar la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tfg_listacompra
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 3.3 Generar la clave de aplicación

```bash
php artisan key:generate
```

### 3.4 Ejecutar migraciones y seeders

```bash
php artisan migrate --seed
```

Esto creará las tablas necesarias (`users`, `supermercados`, `lista_compra`, `producto_lista`) y añadirá datos iniciales a `supermercados` (por ejemplo, Mercadona).

<div class="page-break"></div>

## 4. Compilar los assets del frontend

### 4.1 Instalar dependencias de npm

```bash
npm install
```

### 4.2 Iniciar Vite en modo desarrollo

```bash
npm run dev
```

Esto iniciará un servidor en `http://localhost:5173` que recargará automáticamente los cambios en JavaScript y CSS.

### 4.3 (Opcional) Compilar para producción

```bash
npm run build
```

## 5. Levantar el servidor Laravel

En una nueva terminal:

```bash
php artisan serve
```

La aplicación quedará disponible en `http://localhost:8000`.

<div class="page-break"></div>

## 6. Configurar y levantar la API de productos (Node.js)

### 6.1 Clonar el repositorio del microservicio

```bash
git clone https://github.com/rodriiii94/RoyList-Api.git
cd RoyList-Api
```

### 6.2 Instalar dependencias

```bash
npm install
```

### 6.3 Iniciar el servidor

```bash
node server.js
```

La API estará disponible en `http://localhost:3000`.

## 7. Verificar funcionamiento de la API

Abre en el navegador la siguiente ruta para comprobar la conexión:

```
http://localhost:8000/pruebaApi
```

Debería mostrarse una lista con los productos: `{nombre} - {id}`.

<div class="page-break"></div>

## 8. Acceso a la base de datos

Puedes acceder a la base de datos MySQL en `localhost:3306` usando herramientas como:

* MySQL CLI
* MySQL Workbench
* phpMyAdmin

Verifica que las tablas existen y que la tabla `supermercados` contiene al menos una entrada.

## 9. Despliegue en producción (resumen)

1. Subir el código al servidor.
2. Configurar `.env` con credenciales reales.
3. Ejecutar los siguientes comandos:

```bash
composer install
npm install
npm run build
php artisan migrate
```

4. (Opcional) Ejecutar los seeders:

```bash
php artisan db:seed
```

5. Levantar Laravel (`php artisan serve`, Apache, Nginx, etc.).
6. Iniciar el microservicio con:

```bash
node server.js
```

Con estos pasos, **RoyList** quedará instalado correctamente tanto en entorno de desarrollo como en producción.