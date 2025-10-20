<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id('transfer_id');
            $table->unsignedBigInteger('from_account_id');
            $table->unsignedBigInteger('to_account_id')->nullable();
            $table->string('external_bank', 50)->nullable();
            $table->string('external_account_no', 30)->nullable();
            $table->decimal('amount', 12, 2);
            $table->timestamp('transfer_date')->useCurrent();
            $table->string('status', 10)->default('Pending');
            $table->string('confirm_code', 10)->nullable();

            // Foreign key constraints with restrict on delete
            $table->foreign('from_account_id')
                  ->references('account_id')
                  ->on('accounts')
                  ->onDelete('restrict');

            $table->foreign('to_account_id')
                  ->references('account_id')
                  ->on('accounts')
                  ->onDelete('restrict');

            // Check constraints
            $table->check('status IN ("Pending", "Completed", "Failed")');
            $table->check('amount > 0');

            // Indexes for performance
            $table->index('from_account_id');
            $table->index('to_account_id');
            $table->index('status');
            $table->index('transfer_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
