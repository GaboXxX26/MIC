<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Config; // Importante: añade esta línea

class SelectDbConnection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Leemos la cabecera que nos envía el API Gateway
        $role = $request->header('X-User-Role');

        if ($role) {
            $connectionName = 'mysql_' . strtolower($role);

            // Verificamos si la conexión que queremos usar existe en config/database.php
            if (Config::has("database.connections.$connectionName")) {
                // ¡Esta es la magia! Cambiamos la conexión por defecto para esta solicitud
                Config::set('database.default', $connectionName);
            } else {
                // Si el rol no corresponde a una conexión válida, denegamos el acceso
                return response()->json(['error' => 'Rol de usuario no válido.'], 403);
            }
        } else {
            // Si no viene el rol, denegamos el acceso
            return response()->json(['error' => 'Acceso denegado: rol no especificado.'], 403);
        }

        return $next($request);
    }
}
