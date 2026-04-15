<?php

namespace ArthurPatriot\Tus\Http\Middleware;

use ArthurPatriot\Tus\Exceptions\FileSizeLimitException;
use ArthurPatriot\Tus\Exceptions\VersionMismatchException;
use ArthurPatriot\Tus\Facades\Tus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateFileSizeMiddleware
{
    /**
     * @param  Closure(Request): (Response)  $next
     *
     * @throws VersionMismatchException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ((int) config('tus.file_size_limit') > 0) {

            if ($request->hasHeader('upload-length') && ! Tus::isInMaxFileSize((int) $request->header('upload-length'))) {
                throw new FileSizeLimitException;
            }

            if ($request->hasHeader('content-length') && ! Tus::isInMaxFileSize((int) $request->header('upload-length'))) {
                throw new FileSizeLimitException;
            }

        }

        return $next($request);
    }
}
