### ThrowClientErrorTrait

### ✨ Why Use It?
Sometimes, validation needs to be implemented inside services instead of request classes.
Even when validation is placed in request classes, you may need to add custom logic for it.
This trait helps handle validation errors properly, ensuring the client gets a 422 error when needed.


## Usage
### Throwing a Validation Error
```php
$this->throwClientError('email', 'Invalid credentials.');
```
This sends a structured validation error, making sure the client understands what went wrong.

### Handling Exceptions
```php
try {
    // Some risky operation
} catch (\Throwable $e) {
    $this->throwOrReport($e);
}
```
- In **local/testing**, it throws the error for debugging.
- In **production**, it logs the error instead of breaking the app.

#### 🔹Example: Additional validation for Laravel when validate resolved

```php
class PaymentFormRequest extends FormRequest {

    // this additional validation would be triggered after all basic validation rules would be passed
    public function validateResolved(): void
    {
        parent::validateResolved();
    
        if (!$this->product->is_sellable) {
            $this->throwClientError('error', __('customer.product_unavailable_error'));
        }
    }
}
```

#### 🔹Example: Login Handling in AuthService
```php

class AuthService {

...

    public function login(LoginData $data)
    {
        try {
            $user = User::whereEmail($data->email)
                    ->with('profile')
                    ->firstOrFail();
    
            if ($user->profile->is_2fa_enabled) {
                if (!$data->two_fa_code) {
                    abort(206, 'Two-factor authentication required.');
                }
    
                $google2fa = app(Google2FA::class);
                $valid = $google2fa->verifyKey($user->profile->two_fa_secret, $data->two_fa_code);
    
                if (!$valid) {
                    $this->throwClientError('two_fa_code', 'Invalid 2FA code.');
                }
            }
    
            if (Hash::check($data->password, $user->password)) {
                return ['token' => $user->createToken($data->device_name)->plainTextToken];
            }
    
            $this->throwClientError('email', 'Invalid credentials.');
        } catch (ModelNotFoundException) {
            $this->throwClientError('email', 'Invalid credentials.');
        }
    }
}
```

### 🐸 **Benefits**
- Keeps validation inside services, making code cleaner.
- Ensures proper error handling with **422 responses**.
- Avoids hardcoded error logic in controllers.

This makes error handling smoother and more maintainable.

