<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_scans', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            $table->string('email');
            $table->string('status')->default('queued');
            $table->unsignedBigInteger('exposure_count')->nullable();
            $table->timestamp('checked_at')->nullable();
            $table->timestamp('details_requested_at')->nullable()->index();
            $table->timestamp('followup_completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_scans');
    }
};
