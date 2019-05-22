<?php

namespace App\Http\Middleware;

use App\Exceptions\HttpException\InvalidAcceptHeaderException;
use Closure;

class OnlyJsonResponse
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
        if (!in_array($request->header('accept'), ['*/*', 'application/json'])){
            throw new InvalidAcceptHeaderException();
        }
        $request->headers->set('Accept', 'application/json');

        return $next($request);
    }
}
