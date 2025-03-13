<?php

namespace Concepts\InvokableFactoryValidator\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ConsultingValidator
{
    public function __invoke(Request $request): void
    {
        $validator = Validator::make(
            $request->all(),
            [
                'status' => ['required', 'string', Rule::in(['draft', 'published'])]
            ]
        );
        $validator->validate();
    }
}
