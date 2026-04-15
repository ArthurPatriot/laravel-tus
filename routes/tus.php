<?php

use Illuminate\Support\Facades\Route;
use ArthurPatriot\Tus\Http\Controllers\TusUploadController;
use ArthurPatriot\Tus\Http\Middleware\ValidateChecksumMiddleware;
use ArthurPatriot\Tus\Http\Middleware\ValidateFileSizeMiddleware;
use ArthurPatriot\Tus\Http\Middleware\ValidateVersionMiddleware;

Route::controller(TusUploadController::class)
    ->middleware([...config('tus.middleware'), ValidateVersionMiddleware::class])
    ->prefix(config('tus.path'))
    ->name('tus.')
    ->group(function () {

        Route::match('options', '/', 'options')->name('options');

        Route::match('post', '/', 'post')->name('post')
            ->middleware(ValidateFileSizeMiddleware::class)
            ->middleware(ValidateChecksumMiddleware::class);

        Route::match('head', '/{id}', 'head')->name('head');

        Route::match('patch', '/{id}', 'patch')->name('patch')
            ->middleware(ValidateFileSizeMiddleware::class)
            ->middleware(ValidateChecksumMiddleware::class);

        Route::match('delete', '/{id}', 'delete')->name('delete');

    });
