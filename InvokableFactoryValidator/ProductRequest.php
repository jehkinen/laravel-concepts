<?php

namespace Concepts\InvokableFactoryValidator;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;


class ProductRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:150'],
            'subtitle' => ['sometimes'],
            'description' => ['required', 'max:500'],
            'product_type' => ['required', new Enum(ProductType::class)],
        ];
    }

    public function validateResolved(): void
    {
        parent::validateResolved();
        $this->validateWithFactory($this->input('product_type'));
    }

    private function validateWithFactory(string $productType): void
    {
        $productTypeEnum = ProductType::from($productType);
        $validatorClass = ProductTypeValidatorFactory::build($productTypeEnum);
        $validator = new $validatorClass();
        $validator($this);
    }
}
