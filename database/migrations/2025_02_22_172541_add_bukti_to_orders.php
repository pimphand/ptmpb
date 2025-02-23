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
            $table->string('bukti_pengiriman')->nullable();
            $table->dateTime('tanggal_pengiriman')->nullable();
            $table->text('note')->nullable();
            $table->string('file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('bukti_pengiriman');
            $table->dropColumn('tanggal_pengiriman');
            $table->dropColumn('note');
            $table->dropColumn('file');
        });
    }
};
