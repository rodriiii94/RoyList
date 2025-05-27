# Aplicación de Lista de la Compra en Laravel

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Logo de Laravel">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Estado de Construcción">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Descargas Totales">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Última Versión Estable">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="Licencia">
    </a>
</p>

## Sobre el Proyecto

Esta es una aplicación de lista de la compra basada en Laravel, diseñada para ayudar a los usuarios a gestionar sus listas de compras de manera eficiente. La aplicación ofrece una interfaz intuitiva para agregar, editar y organizar artículos, asegurando una experiencia de compra fluida.

## Características

- Interfaz fácil de usar para gestionar listas de la compra.
- Agregar, editar y eliminar artículos con facilidad.
- Categorizar artículos para una mejor organización.
- Diseño responsivo para uso en móviles y escritorio.
- Construida con el robusto framework de Laravel para escalabilidad y rendimiento.

## Comenzando

Sigue estos pasos para configurar el proyecto localmente:

1. Clona el repositorio:
     ```bash
     git clone https://github.com/your-username/tfg-listacompra.git
     cd RoyList
     ```

2. Instala las dependencias:
     ```bash
     composer install
     npm install
     ```

3. Configura el entorno:
     - Copia `.env.example` a `.env`:
         ```bash
         cp .env.example .env
         ```
     - Configura tu base de datos y otras variables de entorno en el archivo `.env`.

4. Ejecuta las migraciones y llena la base de datos:
     ```bash
     php artisan migrate --seed
     ```

5. Crea una key de aplicación:
     ```bash
     php artisan key:generate
     ```

6. Inicia el servidor de desarrollo:
     ```bash
     php artisan serve
     ```

7. Accede a la aplicación en `http://localhost:8000`.

## Contribuir

¡Las contribuciones son bienvenidas! Por favor, sigue las [directrices de contribución](https://laravel.com/docs/contributions) para comenzar.

## Licencia

Este proyecto es software de código abierto licenciado bajo la [licencia MIT](https://opensource.org/licenses/MIT).
