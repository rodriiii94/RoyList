<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_Controller extends Controller
{
    public function show()
    {
        return view('perfil');
    }

    /**
     * Actualiza la información del usuario autenticado.
     *
     * Valida los datos recibidos en la solicitud, asegurando que el nombre y el correo electrónico
     * cumplan con los requisitos especificados. El correo electrónico debe ser único, excepto para el usuario actual.
     * Si la validación es exitosa, actualiza los datos del usuario y redirige a la ruta 'perfil' con un mensaje de éxito.
     *
     * @param  \Illuminate\Http\Request  $request  Solicitud HTTP con los datos a actualizar.
     * @return \Illuminate\Http\RedirectResponse   Redirección a la vista de perfil con un mensaje de estado.
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
        ]);

        $user->update($data);

        return redirect()->route('perfil')->with('status', 'Perfil actualizado correctamente.');
    }

    /**
     * Elimina la cuenta del usuario autenticado.
     *
     * Este método cierra la sesión del usuario actual, elimina su cuenta de la base de datos
     * y redirige a la página principal con un mensaje de confirmación.
     *
     * @param  \Illuminate\Http\Request  $request  La solicitud HTTP entrante.
     * @return \Illuminate\Http\RedirectResponse   Redirección a la ruta 'index' con un mensaje de estado.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        Auth::logout();
        $user->delete();

        return redirect()->route('index')->with('status', 'Cuenta eliminada correctamente.');
    }
}