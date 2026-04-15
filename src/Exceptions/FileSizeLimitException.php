<?php

namespace ArthurPatriot\Tus\Exceptions;

use ArthurPatriot\Tus\Facades\Tus;
use Symfony\Component\HttpKernel\Exception\HttpException;

class FileSizeLimitException extends HttpException
{
    public function __construct()
    {
        parent::__construct(
            statusCode: 413,
            headers: Tus::headers()->default()->maxSize()->toArray()
        );
    }
}
