<?php

namespace ArthurPatriot\Tus\Events;

use ArthurPatriot\Tus\Helpers\TusFile;
use Illuminate\Foundation\Events\Dispatchable;

class FileUploadStarted
{
    use Dispatchable;

    public function __construct(public TusFile $tusFile)
    {
        //
    }
}
