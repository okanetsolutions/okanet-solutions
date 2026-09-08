<?php

namespace App\Models;

use Database\Factories\EmailScanFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'email'])]
class EmailScan extends Model
{
    /** @use HasFactory<EmailScanFactory> */
    use HasFactory;

    public const Queued = 'queued';

    public const Completed = 'completed';

    public const Failed = 'failed';

    protected function casts(): array
    {
        return [
            'exposure_count' => 'integer',
            'checked_at' => 'datetime',
            'details_requested_at' => 'datetime',
            'followup_completed_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function maskedEmail(): string
    {
        $separator = strrpos($this->email, '@');
        $name = substr($this->email, 0, $separator);
        $domain = substr($this->email, $separator + 1);

        return mb_substr($name, 0, 1).'***@'.$domain;
    }
}
