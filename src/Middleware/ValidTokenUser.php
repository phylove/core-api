<?php

namespace Phy\CoreApi\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Phy\CoreApi\CoreException;

class ValidTokenUser
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $token = $request->header('Authorization');

        if(is_null($token)){
            return [
                'success' => false,
                'error_token' => 'Token not found'
            ];
        }

        try {
            $checkValidToken = app()->make('checkValidToken');
            $checkValidToken->execute(["token" => $token]);
        } catch(CoreException $ex) {
            return [
                'success' => false,
                'error_token' => $ex->getErrorMessage()
            ];
        }
        
        return $next($request);
    }
}
