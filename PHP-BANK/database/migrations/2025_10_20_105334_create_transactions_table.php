<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->unsignedBigInteger('account_id');
            $table->string('type', 20);
            $table->decimal('amount', 12, 2);
            $table->timestamp('transaction_date')->useCurrent();
            $table->string('description', 100)->nullable();
            $table->decimal('balance_after', 12, 2);

            $table->foreign('account_id')
                  ->references('account_id')
                  ->on('accounts')
                  ->onDelete('cascade');

            $table->index('account_id');
            $table->index('type');
            $table->index('transaction_date');
        });

        // Add check constraints using raw SQL
        DB::statement('ALTER TABLE transactions ADD CONSTRAINT chk_transaction_type CHECK (type IN ("Deposit", "Withdrawal", "Transfer"))');
        DB::statement('ALTER TABLE transactions ADD CONSTRAINT chk_transaction_amount CHECK (amount > 0)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
