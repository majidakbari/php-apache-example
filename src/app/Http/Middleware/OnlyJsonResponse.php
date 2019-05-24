<?php

namespace App\Http\Middleware;

use App\Exceptions\HttpException\InvalidAcceptHeaderException;
use Closure;

/**
 * Class OnlyJsonResponse
 * This class will check the `Accept` header of the request and if it will equals to
 * `application/json` or `star/star` will pass the request to the application,
 * other wise will throw an exception
 *
 * @package App\Http\Middleware
 */
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
