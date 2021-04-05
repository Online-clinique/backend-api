<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers;

require_once __DIR__ . "/../Controllers/signJwt.php";

class jwtMiddleware
{
    public function handle($request, Closure $next)
    {
        try {
            $auth_value = $request->cookie('auth:token');
            if ($auth_value) {
                $request->request->add(["currentUser" => decodeJwt($auth_value)]);
            } else {
                throw new Exception("No cookie found", 1);
                
            }
        } catch (\Throwable $th) {
            $request->request->add(["currentUser" => null]);
        }

        return $next($request);
    }

}