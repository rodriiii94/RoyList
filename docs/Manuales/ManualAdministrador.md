## Manual de Administrador

Este manual explica cómo poner en marcha el entorno de desarrollo de RoyList, desplegando tanto el backend en Laravel como el microservicio de API en Node.js, y configurando la base de datos MySQL.

### 1. Requisitos del sistema

* **Git**
* **PHP 8.2+**
* **Composer**
* **Laravel 10+**
* **Node.js 16+ y npm**
* **MySQL 8 (o MariaDB compatible)**
* **Extensiones PHP necesarias:** `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`

### 2. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/RoyList.git
cd RoyList
```

### 3. Configurar Laravel

1. **Instalar dependencias PHP**

   ```bash
   composer install
   ```

2. **Copiar y editar el archivo de entorno**

   ```bash
   cp .env.example .env
   ```

   En `.env` configura los accesos a la base de datos:

   ```java
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=tfg_listacompra
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

3. **Generar la clave de la aplicación**

   ```bash
   php artisan key:generate
   ```

4. **Ejecutar migraciones y seeders**

   ```bash
   php artisan migrate --seed
   ```

   Esto creará las tablas (`users`, `supermercados`, `lista_compra`, `producto_lista`) y rellenará la tabla `supermercados` con las cadenas iniciales (p. ej. Mercadona).

### 4. Compilar assets frontend

1. **Instalar dependencias npm**

   ```bash
   npm install
   ```

2. **Iniciar Vite en modo desarrollo**

   ```bash
   npm run dev
   ```

   Esto levantará un servidor en `http://localhost:5173` que recargará automáticamente CSS/JS al guardar.

3. **(Opcional) Compilar para producción**

   ```bash
   npm run build
   ```

   Los archivos compilados se colocarán en `public/build`.

### 5. Levantar el servidor Laravel

En una terminal:

```bash
php artisan serve --host=localhost --port=8000
```

La aplicación quedará accesible en:

`http://localhost:8000`

### 6. Configurar y levantar la API de productos

1. **Clonar el repositorio del microservicio Node.js**

En una nueva terminal, clona el repositorio del microservicio que gestiona los productos:

```bash
git clone https://github.com/tu-usuario/RoyList-Api.git
cd RoyList-Api
```

2. **Instalar dependencias**

   ```bash
   npm install
   ```

3. **Iniciar el servidor Node.js**

   ```bash
   node server.js
   ```

   El API quedará accesible en:

   `http://localhost:3000`

### 7. Verificar la conexión

* Comprueba que la ruta de Laravel `/pruebaApi` carga correctamente.

  `http://localhost:8000/pruebaApi`

  Debe devolver una pagina con todos los productos en formato lista: {nombre} - {id}.

### 8. Acceso a la base de datos

* Conéctate a MySQL en `localhost:3306` usando tu cliente preferido (MySQL CLI, MySQL Workbench, phpMyAdmin, etc.).
* Verifica que existen las tablas migradas y que `supermercados` contiene al menos la entrada inicial.

### 9. Despliegue en producción (resumen)

1. Subir código al servidor o en local.
2. Ajustar `.env` con credenciales y dominios reales.
3. Ejecutar `composer install`, `npm install`, `npm run build`.
4. Ejecutar migraciones en la base de datos productiva `php artisan migrate`.
5. Levantar el servicio Vite en producción `npm run dev`.
6. Levantar el servidor Laravel `php artisan serve`.
7. Levantar el microservicio Node.js `node server.js`.

Con estos pasos, RoyList quedará instalado y disponible tanto en entorno de desarrollo como en producción.
