<?php

namespace ArthurPatriot\Tus\Events;

use Illuminate\Foundation\Events\Dispatchable;
use ArthurPatriot\Tus\Helpers\TusFile;

class FileUploadStarted
{
    use Dispatchable;

    public function __construct(public TusFile $tusFile)
    {
        //
    }
}
