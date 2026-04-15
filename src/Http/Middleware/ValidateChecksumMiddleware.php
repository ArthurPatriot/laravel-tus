<?php

namespace ArthurPatriot\Tus\Http\Middleware;

use ArthurPatriot\Tus\Exceptions\ChecksumAlgorithmMismatchException;
use ArthurPatriot\Tus\Exceptions\ChecksumMismatchException;
use ArthurPatriot\Tus\Facades\Tus;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateChecksumMiddleware
{
    /**
     * @param  Closure(Request): (Response)  $next
     *
     * @throws ChecksumAlgorithmMismatchException
     * @throws ChecksumMismatchException
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->hasHeader('upload-checksum') && Tus::extensionIsActive('checksum')) {

            $checksumData = explode(' ', $request->hasHeader('upload-checksum'));

            if (! in_array($checksumData[0], (array) config('tus.checksum_algorithm'))) {
                throw new ChecksumAlgorithmMismatchException;
            }

            if (! Tus::isValidChecksum($checksumData[0], $checksumData[1], $request->getContent())) {
                throw new ChecksumMismatchException;
            }

        }

        return $next($request);
    }
}
