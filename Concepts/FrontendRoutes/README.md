### Frontend URL Generation

### ✨ Why Use It?

Very often, you need to send emails and notifications containing links to the frontend app
from the backend. 
This approach helps manage frontend URLs and parameters in one clean and easy-to-maintain place.

🔹 It ensures consistency, security, and scalability while keeping URLs simple and avoiding hardcoded links.

```php
$paymentSuccessUrl = FrontendAppRoutes::PAYMENT_SUCCESS_URL->getUrl([
    'username'  => 'debra_morgan',
    'productId' => 755,
    'orderId'   => 2268372860,
]);
```
🔗 Payment Success URL:
https://app.example.io/debra_morgan/755/2268372860

```php
$passwordResetUrl = FrontendAppRoutes::PASSWORD_RESET->getUrl([
    'token'   => '2bfcccc046741874ad624ee93ad9ff09',
]);
```
🔗 Password Reset Url:
https://app.example.io/auth/password-reset/2bfcccc046741874ad624ee93ad9ff09


