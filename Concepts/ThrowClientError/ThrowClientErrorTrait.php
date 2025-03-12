<?php

namespace Concepts;

use Illuminate\Support\Facades\App;
use Illuminate\Validation\ValidationException;

trait ThrowClientErrorTrait
{
    public function throwClientError(string $field, string $message)
    {
        throw ValidationException::withMessages([
            $field => $message,
        ]);
    }

    public function throwOrReport(\Throwable $throwable)
    {
        if (App::environment('local', 'testing') || App::hasDebugModeEnabled()) {
            throw $throwable;
        } else {
            report($throwable);
        }
    }
}

