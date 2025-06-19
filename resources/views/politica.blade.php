@extends('layouts.app')

@section('title', 'Política de Privacidad - RoyList')

@section('content')

<section class="bg-white dark:bg-gray-900 py-16">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            {{-- Título --}}
            <div class="text-center mb-12 mt-12">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4">Política de Privacidad</h1>
                <p class="text-gray-600 dark:text-gray-200">Última actualización: 16 de mayo de 2025</p>
            </div>

            {{-- Introducción --}}
            <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-200 mb-12">
                <p>
                    Esta Política de Privacidad describe cómo recogemos, usamos y protegemos tu información personal cuando usas RoyList.
                </p>
            </div>

            {{-- Contenido --}}
            <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-200">
                {{-- Sección 1 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">1. Información que recopilamos</h2>
                    <p class="mb-4">
                        Al usar RoyList, podemos recopilar los siguientes datos:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 mb-4">
                        <li><span class="font-medium">Información de registro:</span> nombre, correo electrónico, contraseña (cifrada).</li>
                        <li><span class="font-medium">Datos generados por el usuario:</span> listas de la compra, productos añadidos, supermercados seleccionados.</li>
                        <li><span class="font-medium">Información técnica:</span> tipo de navegador, dirección IP, sistema operativo.</li>
                    </ul>
                </div>

                {{-- Sección 2 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4 dark:text-gray-100">2. Uso de la información</h2>
                    <p class="mb-2">
                        Utilizamos tus datos para:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Proporcionarte acceso personalizado a tu cuenta.</li>
                        <li>Almacenar tus listas y configuraciones.</li>
                        <li>Mejorar la experiencia del usuario.</li>
                        <li>Analizar patrones de uso de forma anónima para mejorar el servicio.</li>
                    </ul>
                </div>

                {{-- Sección 3 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">3. Compartición de datos</h2>
                    <p class="mb-4">
                        No compartimos tus datos personales con terceros, salvo en los siguientes casos:
                    </p>
                    <ul class="list-disc pl-6 space-y-2">
                        <li>Por requerimiento legal.</li>
                        <li>Para proteger los derechos y seguridad de los usuarios o de la Aplicación.</li>
                        <li>Con proveedores de servicios que nos ayudan a operar la Aplicación (como alojamiento web), quienes están sujetos a acuerdos de confidencialidad.</li>
                    </ul>
                </div>

                {{-- Sección 4 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">4. Seguridad</h2>
                    <p>
                        Tomamos medidas razonables para proteger tu información mediante cifrado, control de acceso y otras prácticas de seguridad. Sin embargo, ningún sistema es 100% seguro.
                    </p>
                </div>

                {{-- Sección 5 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">5. Cookies</h2>
                    <p>
                        La Aplicación puede utilizar cookies para mantener tu sesión activa y mejorar la navegación. Puedes configurar tu navegador para rechazarlas, pero esto puede limitar ciertas funciones.
                    </p>
                </div>

                {{-- Sección 6 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">6. Derechos del usuario</h2>
                    <p class="mb-4">
                        Tienes derecho a:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 mb-4">
                        <li>Acceder a tus datos personales.</li>
                        <li>Solicitar la corrección o eliminación de tus datos.</li>
                        <li>Retirar tu consentimiento y eliminar tu cuenta en cualquier momento.</li>
                    </ul>
                    <p>
                        Puedes ejercer estos derechos escribiéndonos a: <a href="mailto:contacto@roylist.com" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700">contacto@roylist.com</a>
                    </p>
                </div>

                {{-- Sección 7 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100 mb-4">7. Cambios en la política</h2>
                    <p>
                        Nos reservamos el derecho a modificar esta Política. Notificaremos los cambios importantes en la Aplicación o por correo electrónico si corresponde.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection