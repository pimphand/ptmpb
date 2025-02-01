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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment')->nullable();
            $table->string('proof_of_payment')->nullable();
            $table->string('pay_at')->nullable();
            $table->bigInteger('amount')->nullable();
            $table->foreignId('driver_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('payment');
            $table->dropColumn('proof_of_payment');
            $table->dropColumn('pay_at');
            $table->dropColumn('amount');
            $table->dropForeign(['driver_id']);
            $table->dropColumn('driver_id');
        });
    }
};
