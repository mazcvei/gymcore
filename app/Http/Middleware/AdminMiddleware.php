<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }
    
        $adminRoleId = Role::where('name', 'admin')->value('id');


        if ($user->role_id !== $adminRoleId) {
            abort(403, 'No tienes permisos de administrador');
        }

        return $next($request);
    }
}