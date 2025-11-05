<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This table stores temporary 6-digit verification codes
     * sent via email for 2FA.
     */
    public function up(): void
    {
        Schema::create('two_fa_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('account_id');
            $table->string('code', 6);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('expires_at');
            $table->boolean('used')->default(false);

            // Foreign key constraint
            $table->foreign('account_id')
                  ->references('account_id')
                  ->on('accounts')
                  ->onDelete('cascade');

            // Indexes for quick lookups
            $table->index('account_id');
            $table->index(['account_id', 'code', 'used']);
            $table->index('expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('two_fa_codes');
    }
};
