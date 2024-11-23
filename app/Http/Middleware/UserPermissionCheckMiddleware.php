<?php

namespace App\Http\Middleware;

use App\Facades\AuthUserFacade;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserPermissionCheckMiddleware
{
    public function handle(Request $request, Closure $next, string ...$permissions): Response
    {
        $userPermissions = AuthUserFacade::getGrantedPermissionsAsArray();

        if (count($userPermissions) === 0) {
            return redirect()->back();
        }

        if (in_array(needle: 'superuser', haystack: $userPermissions)) {
            return $next($request);
        }

        foreach ($permissions as $permission) {
            if (in_array(needle: $permission, haystack: $userPermissions)) {
                return $next($request);
            }
        }

        return redirect()->back();
    }
}
