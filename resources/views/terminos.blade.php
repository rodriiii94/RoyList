@extends('layouts.app')

@section('title', 'Términos de Servicio - RoyList')

@section('content')

<section class="bg-white py-16">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            {{-- Título --}}
            <div class="text-center mb-12 mt-12">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-4">Términos de Servicio</h1>
                <p class="text-gray-600">Última actualización: 16 de mayo de 2025</p>
            </div>

            {{-- Contenido --}}
            <div class="prose prose-lg max-w-none text-gray-700">
                <p class="mb-6">
                    Bienvenido a RoyList, una plataforma web que permite a los usuarios gestionar sus listas de la compra de forma organizada y personalizada. Al utilizar RoyList, aceptas cumplir con estos Términos de Servicio. Si no estás de acuerdo con ellos, por favor no utilices nuestros servicios.
                </p>

                {{-- Sección 1 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">1. Uso de la Aplicación</h2>
                    <p class="mb-4">
                        RoyList está diseñada para ayudar a los usuarios a crear, editar y organizar listas de la compra. Cada usuario debe registrarse con una cuenta personal para utilizar las funcionalidades completas del sistema.
                    </p>
                    <p class="mb-2">
                        Está prohibido:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 mb-4">
                        <li>Usar la aplicación para fines ilegales o no autorizados.</li>
                        <li>Acceder o intentar acceder a cuentas de otros usuarios.</li>
                        <li>Interferir con la seguridad, estabilidad o integridad de la plataforma.</li>
                    </ul>
                </div>

                {{-- Sección 2 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">2. Registro y Seguridad</h2>
                    <p>
                        Debes proporcionar información veraz al crear una cuenta. Eres responsable de mantener la confidencialidad de tus credenciales de acceso y de todas las actividades que ocurran bajo tu cuenta.
                    </p>
                </div>

                {{-- Sección 3 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">3. Contenido del Usuario</h2>
                    <p>
                        Todo contenido que subas o generes en la Aplicación (como productos o listas) te pertenece, pero nos concedes una licencia limitada para almacenar, mostrar y procesar ese contenido con el fin de ofrecerte el servicio.
                    </p>
                </div>

                {{-- Sección 4 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">4. Disponibilidad del Servicio</h2>
                    <p>
                        Nos reservamos el derecho de modificar o interrumpir, temporal o permanentemente, la aplicación sin previo aviso. No nos hacemos responsables por cualquier pérdida de datos o interrupción del servicio.
                    </p>
                </div>

                {{-- Sección 5 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">5. Modificaciones</h2>
                    <p>
                        Podemos actualizar estos Términos en cualquier momento. Si realizamos cambios significativos, lo notificaremos dentro de la propia aplicación o por otros medios razonables.
                    </p>
                </div>

                {{-- Sección 6 --}}
                <div class="mb-8">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">6. Contacto</h2>
                    <p>
                        Si tienes alguna duda sobre estos Términos, puedes contactarnos en: <a href="mailto:contacto@roylist.com" class="text-emerald-600 hover:text-emerald-700">contacto@roylist.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection