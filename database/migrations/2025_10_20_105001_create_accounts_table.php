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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('account_id');
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->date('dob');
            $table->string('phone_no', 15)->unique();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->char('two_fa_enabled', 1)->default('N');
            $table->char('status', 1)->default('A');
            $table->decimal('balance', 12, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->index('email');
            $table->index('phone_no');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
