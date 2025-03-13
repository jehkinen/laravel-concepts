<?php

namespace Concepts\InvokableFactoryValidator\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OneTimeProductValidator
{

    public function __invoke(Request $request): void
    {
        $validator = Validator::make(
            $request->all(),
            [
                'quantity' => ['sometimes', 'integer'],
            ]
        );
        $validator->validate();
    }
}
