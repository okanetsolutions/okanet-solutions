<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PublicDomain implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || strlen($value) > 253
            || ! preg_match('/\A(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z]{2,63}\z/', $value)
            || preg_match('/\.(?:localhost|local|internal|test|invalid|example|onion)\z/', $value)) {
            $fail('Introduce un dominio público, sin https://, rutas, direcciones IP ni comodines.');
        }
    }
}
