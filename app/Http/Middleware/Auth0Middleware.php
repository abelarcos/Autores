<?php

namespace App\Http\Middleware;

use Closure;

use Auth0\SDK\JWTVerifier;
use Auth0\SDK\Helpers\Cache\FileSystemCacheHandler;

class Auth0Middleware{

    public function handle($request, Closure $next){

        if(!$request->hasHeader('Authorization')){

            return response()->json('Encabezado de autorización no encontrado', 401);

        }
        $token = $request->bearerToken();

        if($request->header('Authorization') == null || $token == null){

            return response('No se proporciono un token', 401);
        }

        $this->retrieveAndValidateToken($token);

        return $next($request);
    }

    public function retrieveAndValidateToken($token){
        try{

            $verifier = new JWTVerifier([

                'supported_algs' => ['RS256'],
                'valid_audiences' => ['https://autoresapi.com'],
                'authorized_iss' => ['https://dev-1q1slviu.auth0.com'],
                'cache' => new FileSystemCacheHandler() //Este parámetro es opcional. De forma predeterminada, no se usa caché para recuperar las claves web JSON. 

            ]);

            $decoded = $verifier->verifyAndDecode($token);

        }catch(\Auth0\SDK\Exception\CoreException $e){

            throw $e;

        };
    }

}