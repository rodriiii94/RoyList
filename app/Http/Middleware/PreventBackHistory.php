<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventBackHistory {
    
    /**
     * Middleware para prevenir que el navegador almacene en caché las páginas,
     * evitando así que el usuario pueda navegar hacia atrás después de cerrar sesión u otras acciones sensibles.
     *
     * Establece las cabeceras HTTP 'Cache-Control', 'Pragma' y 'Expires' para deshabilitar el almacenamiento en caché.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante.
     * @param  \Closure  $next  El siguiente middleware en la cadena.
     * @return \Symfony\Component\HttpFoundation\Response  La respuesta HTTP con las cabeceras modificadas.
     */
    public function handle(Request $request, Closure $next) {
        $response = $next($request);

        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}