<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BooleanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->replace($this->transform($request->all()));
        return $next($request);
    }


    /**
     * Transform boolean strings to boolean
     * @param array $parameters
     * @return array
     */
    private function transform(array $parameters): array
    {
        return collect($parameters)->map(function ($param) {
            if ($param == 'true' || $param == 'false' ||  $param == 'on' ||  $param == 'yes'){
                return filter_var($param, FILTER_VALIDATE_BOOLEAN);
            }

            return $param;
        })->all();
    }

}
