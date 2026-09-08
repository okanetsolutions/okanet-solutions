<?php

namespace App\Models;

use Database\Factories\SecurityAssessmentFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'domain', 'dns_token', 'dns_expires_at'])]
#[Hidden(['report_path', 'dns_token', 'authorization_ip'])]
class SecurityAssessment extends Model
{
    /** @use HasFactory<SecurityAssessmentFactory> */
    use HasFactory;

    public const PendingVerification = 'pending_verification';

    public const Requested = 'requested';

    public const InProgress = 'in_progress';

    public const ReportReady = 'report_ready';

    public const Delivered = 'delivered';

    protected function casts(): array
    {
        return array_fill_keys([
            'dns_expires_at', 'dns_verified_at', 'authorized_at', 'due_at',
            'report_ready_at', 'delivered_at', 'full_report_requested_at', 'followup_completed_at',
        ], 'datetime');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function dnsName(): string
    {
        return '_okanet-verification.'.$this->domain;
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            self::Requested => 'Solicitada',
            self::InProgress => 'En revisión',
            self::ReportReady => 'Informe preparado',
            self::Delivered => 'Informe entregado',
            default => 'Verificación pendiente',
        };
    }
}
