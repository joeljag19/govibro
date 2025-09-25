<?php

namespace App\Controllers;

class LanguageController extends BaseController
{
    public function set($locale)
    {
        // Usamos la función config('App') para acceder a la configuración de forma segura.
        $supportedLocales = config('App')->supportedLocales;

        // Validar que el idioma esté soportado
        if (!in_array($locale, $supportedLocales)) {
            return redirect()->back()->with('error', 'Idioma no soportado.');
        }

        // Guardar el idioma en la sesión del usuario
        session()->set('user_locale', $locale);
        
        // Redirigir al usuario a la página anterior
        return redirect()->back();
    }
}