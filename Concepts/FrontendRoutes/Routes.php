<?php

namespace Concepts;

enum FrontendAppRoutes: string
{
    case EMAIL_CONFIRMATION = '/auth/email/confirmation/{token}';
    case PAYMENT_SUCCESS_URL = '{username}/{productId}/{orderId}';
    case PASSWORD_RESET = 'auth/password-reset/{token}';
    case SUBSCRIPTION_CANCEL = 'unsubscribe/{id}';
    case PRODUCT_PAYMENT_LINK_URL = '{username}/{productId}?uuid={uuid}';

    private function requiredParams(): array
    {
        return match ($this) {
            self::EMAIL_CONFIRMATION, self::PASSWORD_RESET => ['token'],
            self::PAYMENT_SUCCESS_URL => ['username', 'productId', 'orderId'],
            self::SUBSCRIPTION_CANCEL => ['id'],
            // any other frontend urls

            default => throw new \Error('This URL template does not exist'),
        };
    }

    public function getUrl(array $params = []): string
    {
        $baseUrl = config('frontend_url'); // URL from your env for e.g config('frontend_url')
        $path = $this->replaceParams($this->value, $params, $this->requiredParams());

        return "{$baseUrl}/{$path}";
    }
    private function replaceParams(string $url, array $params, array $requiredParams = []): string
    {
        if ($missing = array_diff($requiredParams, array_keys($params))) {
            throw new \InvalidArgumentException("Missing required parameters: " . implode(', ', $missing));
        }

        return preg_replace_callback('/\{(\w+)}/', function ($matches) use ($params) {
            return $params[$matches[1]] ?? $matches[0];
        }, $url);
    }
}
