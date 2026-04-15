<?php

namespace ArthurPatriot\Tus\Http\Middleware;

use ArthurPatriot\Tus\Exceptions\VersionMismatchException;
use ArthurPatriot\Tus\Facades\Tus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateVersionMiddleware
{
    /**
     * @param  Closure(Request): (Response)  $next
     *
     * @throws VersionMismatchException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('tus-resumable') !== Tus::version()) {
            throw new VersionMismatchException;
        }

        return $next($request);
    }
}
