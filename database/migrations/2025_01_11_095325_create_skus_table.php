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
        Schema::create('skus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('product_id')->constrained('products');
            $table->string('name')->index();
            $table->string('code')->unique();
            $table->integer('price')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('depth')->nullable();
            $table->integer('stock')->nullable();
            $table->boolean('is_publish')->default(true);
            $table->string('packaging')->nullable();
            $table->string('application')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skus');
    }
};
