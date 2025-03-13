🎯 Dynamic Validation with Factory & Custom Validators

✨ Why Use It?

When working with different domain-specific models, validation often requires both shared and type-specific rules.
Instead of cluttering the request class, we delegate validation logic to specialized validators, ensuring better scalability and maintainability.

We’ll consider this approach using product types as an example.

🐸 Benefits
- Ensures clean and structured validation logic.
- Allows scalable and flexible validation for different entity types.
- Keeps request classes lightweight by offloading validation to dedicated classes.


```php
class ProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'         => ['sometimes', 'string', 'max:150'],
            'subtitle'      => ['sometimes'],
            'description'   => ['required', 'max:500'],
            'product_type'  => ['required', new Enum(ProductType::class)],
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
        (new $validatorClass())->validate($this);
    }
}
```

- ***Base request validation*** ensures all products follow common rules.

- ***Factory pattern*** dynamically selects the appropriate validator.

- ***Each validator*** encapsulates its own validation logic, keeping the request class clean.
