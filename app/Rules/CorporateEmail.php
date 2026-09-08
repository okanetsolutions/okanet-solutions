<?php

namespace App\Rules;

use App\Services\DnsLookup;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CorporateEmail implements ValidationRule
{
    public function __construct(private DnsLookup $dns) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || ! str_contains($value, '@')) {
            $fail('Introduce tu correo corporativo.');

            return;
        }

        $domain = strtolower(substr(strrchr($value, '@'), 1));
        foreach (config('security.blocked_email_domains') as $blocked) {
            if ($domain === $blocked || str_ends_with($domain, '.'.$blocked)) {
                $fail('Utiliza un correo corporativo; no se admiten proveedores personales ni correos temporales.');

                return;
            }
        }

        (new PublicDomain)->validate($attribute, $domain, $fail);

        if (! $this->dns->hasMailServer($domain)) {
            $fail('El dominio de tu correo debe tener un servidor de correo válido.');
        }
    }
}
