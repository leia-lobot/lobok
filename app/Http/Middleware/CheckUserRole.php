<?php

namespace App\Http\Middleware;

use Closure;
use App\Role\RoleChecker;
use Illuminate\Auth\Access\AuthorizationException;

class CheckUserRole
{
    protected $roleChecker;

    public function __Construct(RoleChecker $roleChecker)
    {
        $this->roleChecker = $roleChecker;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (($user = auth()->user()) instanceof \App\User) {
            if (!$this->roleChecker->check($user, $role)) {
                throw new AuthorizationException('You do not have permission to view this page');
            }
        } else {
            return redirect('/login');
        }

        return $next($request);
    }
}
