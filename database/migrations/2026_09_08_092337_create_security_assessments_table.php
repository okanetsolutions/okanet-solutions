<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('security_assessments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('domain', 253);
            $table->string('dns_token', 64);
            $table->timestamp('dns_expires_at');
            $table->timestamp('dns_verified_at')->nullable();
            $table->string('status')->default('pending_verification');
            $table->string('authorized_by')->nullable();
            $table->string('authorization_email')->nullable();
            $table->string('authorization_ip', 45)->nullable();
            $table->string('authorization_version')->nullable();
            $table->text('authorization_text')->nullable();
            $table->timestamp('authorized_at')->nullable();
            $table->timestamp('due_at')->nullable();
            $table->text('summary')->nullable();
            $table->string('report_path')->nullable();
            $table->timestamp('report_ready_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('full_report_requested_at')->nullable();
            $table->timestamp('followup_completed_at')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'domain']);
            $table->index(['status', 'due_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('security_assessments');
    }
};
