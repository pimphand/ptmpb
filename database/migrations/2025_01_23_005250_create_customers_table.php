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
        Schema::create('customers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->index();
            $table->string('phone')->unique();
            $table->string('address')->index();
            $table->string('owner_address')->index()->nullable();
            $table->string('store_name')->index();
            //
            $table->string('store_photo')->nullable();
            $table->string('owner_photo')->nullable();
            $table->string('identity')->nullable()->index();
            $table->string('npwp')->nullable()->index();
            $table->string('others')->nullable();
            $table->boolean('is_blacklist')->default(false);
            $table->softDeletes();
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->foreignUuid('customer_id')->nullable()->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('customer_id');
            $table->dropColumn('customer_id');
        });

        Schema::dropIfExists('customers');
    }
};
