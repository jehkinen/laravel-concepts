<?php

namespace Concepts\InvokableFactoryValidator\Validators;


use Concepts\InvokableFactoryValidator\ProductRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RecurringMembershipValidator
{
    public function __invoke(ProductRequest $request): void
    {
        $validator = Validator::make(
            $request->all(),
            [
                'interval' => ['required', Rule::in(['day', 'month', 'year'])],
                'interval_count' => ['required', 'integer'],
            ]
        );
        $validator->validate();
    }
}
