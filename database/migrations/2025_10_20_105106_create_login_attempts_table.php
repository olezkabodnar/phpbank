<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This table tracks failed login attempts for security purposes.
     * After 3 failed attempts, the account is locked for 15 minutes.
     */
    public function up(): void
    {
        Schema::create('login_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('email', 50);
            $table->string('ip_address', 45);
            $table->timestamp('attempted_at')->useCurrent();
            $table->boolean('successful')->default(false);

            // Indexes for quick lookups
            $table->index('email');
            $table->index(['email', 'attempted_at']);
            $table->index('ip_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_attempts');
    }
};
