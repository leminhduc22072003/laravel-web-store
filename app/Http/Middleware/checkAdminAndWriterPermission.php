<?php

namespace App\Http\Middleware;

use Closure;

class checkAdminAndWriterPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->session()->get('user');
        if ($user['group'] != GROUP_ADMIN && $user['group'] != GROUP_WRITER) {
            return redirect()->route('admin.dashboard');
        }
        return $next($request);
    }
}
