<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleManage
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        return match($user->role) {
            'admin'      => $request->is('admin/*') ? abort(403, 'Role mismatch di konfigurasi rute.') : redirect()->route('admin.dashboard'),
            'pakar'      => $request->is('pakar/*') ? abort(403, 'Role mismatch di konfigurasi rute.') : redirect()->route('pakar.dashboard'),
            'masyarakat' => $request->is('masyarakat/*') ? abort(403, 'Role mismatch di konfigurasi rute.') : redirect()->route('dashboard'),
            default      => redirect()->route('login'),
        };
    }
}