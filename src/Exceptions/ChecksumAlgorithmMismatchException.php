<?php

namespace ArthurPatriot\Tus\Exceptions;

use ArthurPatriot\Tus\Facades\Tus;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ChecksumAlgorithmMismatchException extends HttpException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 400,
            headers: Tus::headers()->default()->toArray()
        );
    }
}
