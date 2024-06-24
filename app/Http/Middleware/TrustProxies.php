<?php

namespace App\Http\Middleware;

use Closure;

class TrustProxies
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
        // İstek sonrası dönen yanıtı alalım
        $response = $next($request);

        // CORS başlıklarını ekleyelim
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        // Son olarak, yanıtı döndürelim
        return $response;
    }
}
