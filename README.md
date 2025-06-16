# 🛒 RoyList – Aplicación de Lista de la Compra con Laravel

[![Ask DeepWiki](https://deepwiki.com/badge.svg)](https://deepwiki.com/rodriiii94/RoyList)

<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Logo de Laravel">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Estado de construcción">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Descargas totales">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Última versión estable">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="Licencia">
    </a>
</p>

---

## 📌 Descripción del Proyecto

**RoyList** es una aplicación web desarrollada con Laravel 12 que permite a los usuarios gestionar listas de la compra de forma personalizada por supermercado. Integra un catálogo actualizado desde una API externa, permitiendo añadir productos clasificados por categoría con una interfaz sencilla, moderna y responsive.

Este proyecto ha sido desarrollado como parte del Trabajo de Fin de Ciclo del ciclo superior de Desarrollo de Aplicaciones Web (DAW).

---

## ✨ Características

- Registro de usuarios con verificación de correo electrónico.
- Gestión de múltiples listas por supermercado.
- Añadir y eliminar productos desde un catálogo externo actualizado.
- Visualización de productos agrupados por categoría.
- Interfaz responsive con Tailwind CSS 4.
- API propia desarrollada con Node.js y scraping de Mercadona.
- Almacenamiento en caché para mejorar el rendimiento.

---

## ⚙️ Requisitos

- PHP 8.2 o superior
- Composer
- Node.js 16 o superior
- MySQL 8 o compatible
- Extensiones PHP requeridas: `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`

---

## 🧪 Instalación local

```bash
# Clonar el repositorio
git clone https://github.com/tu-usuario/RoyList.git
cd RoyList

# Instalar dependencias
composer install
npm install && npm run build

# Configurar variables de entorno
cp .env.example .env
php artisan key:generate

# Configurar .env con tu base de datos y correo
php artisan migrate

# Iniciar el servidor
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`

---

## 🌐 Estructura del Proyecto

```bash
├── app/
├── database/
├── public/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── .env
└── vite.config.js
```

---

## 📡 API de Productos

RoyList se conecta a una API personalizada construida con Node.js y Express, que obtiene los productos mediante scraping del sitio web de Mercadona. Los datos se presentan agrupados por categorías y almacenados en caché para mejorar la eficiencia de carga.

Repositorio de la API: [`RoyList-Api`](https://github.com/rodriiii94/RoyList-Api)

---

## 🤝 Contribuciones

¡Las contribuciones son bienvenidas! Si deseas mejorar este proyecto, por favor abre un issue o un pull request. Sigue las [directrices de Laravel](https://laravel.com/docs/contributions) si quieres mantener buenas prácticas.

---

## 📄 Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).

---

## 👨‍💻 Autor

**José Rodrigo Santamaría**
Desarrollado como parte del TFG del Ciclo Superior de Desarrollo de Aplicaciones Web (DAW).
Contacto: [rodrisantaga94@gmail.com](mailto:rodrisantaga94@gmail.com)
