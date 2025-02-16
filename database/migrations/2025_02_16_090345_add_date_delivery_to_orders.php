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
            $table->date('date_delivery')->nullable();
            $table->boolean('is_return')->default(false);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['date_delivery','is_return']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('file');
        });
    }
};
