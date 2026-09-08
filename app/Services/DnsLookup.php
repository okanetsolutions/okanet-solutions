<?php

namespace App\Services;

class DnsLookup
{
    public function hasMailServer(string $domain): bool
    {
        $records = @dns_get_record($domain, DNS_MX);

        foreach ($records ?: [] as $record) {
            if (! empty($record['target']) && $record['target'] !== '.') {
                return true;
            }
        }

        return false;
    }

    public function hasTxtRecord(string $name, string $expected): bool
    {
        $records = @dns_get_record($name, DNS_TXT);

        foreach ($records ?: [] as $record) {
            $value = isset($record['entries']) ? implode('', $record['entries']) : ($record['txt'] ?? '');
            if (hash_equals($expected, $value)) {
                return true;
            }
        }

        return false;
    }
}
