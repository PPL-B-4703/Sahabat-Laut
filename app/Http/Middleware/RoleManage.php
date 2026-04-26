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
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Sesi berakhir, silakan login kembali.'], 401);
            }
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Anda tidak memiliki akses ke fitur ini.'], 403);
        }

        return match($user->role) {
            'admin'      => $request->is('admin/*') ? abort(403, 'Role mismatch.') : redirect()->route('admin.dashboard'),
            'pakar'      => $request->is('pakar/*') ? abort(403, 'Role mismatch.') : redirect()->route('pakar.dashboard'),
            'masyarakat' => $request->is('masyarakat/*') ? abort(403, 'Role mismatch.') : redirect()->route('dashboard'),
            default      => redirect()->route('login'),
        };
    }
}