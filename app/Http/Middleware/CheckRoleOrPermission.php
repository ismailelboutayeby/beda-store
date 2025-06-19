<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleOrPermission
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$rolesOrPermissions)
    {
        $user = Auth::user();
        if (!$user) {
            abort(403, 'Unauthorized');
        }

        foreach ($rolesOrPermissions as $item) {
            if ($user->roles()->where('name', $item)->exists() || $user->permissions()->where('name', $item)->exists()) {
                return $next($request);
            }
        }

        abort(403, 'Forbidden');
    }
}
