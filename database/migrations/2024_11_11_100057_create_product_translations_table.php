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
        Schema::create('product_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('product_id');
            $table->string('language_code')->default('vi');
            $table->string('name');//tên sản phẩm
            $table->text('description')->nullable();//mô tả
            $table->timestamps();

            // Thiết lập khóa ngoại cho product_id
            $table->foreign('product_id')
                ->references('id')
                ->on('product')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_translations');
    }
};
