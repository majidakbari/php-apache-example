<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests;
use RuntimeException;


/**
 * Class AdvancedThrottleRequests
 * @package App\Http\Middleware
 */
class AdvancedThrottleRequests extends ThrottleRequests
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    protected function resolveRequestSignature($request)
    {
        if ($route = $request->route()) {
            return sha1(
                implode('|', $request->route()->methods()) .
                '|' . $request->route()->domain() .
                '|' . $request->route()->uri() .
                '|' . $request->ip() .
                '|' . implode('|', $request->cookie()) .
                '|' . $request->userAgent() .
                '|' . $request->header('authorization')

            );
        }

        throw new RuntimeException('Unable to generate the request signature. Route unavailable.');
    }
}
