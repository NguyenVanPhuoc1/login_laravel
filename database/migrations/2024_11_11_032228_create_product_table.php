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
        Schema::create('product', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('cate_id');//id danh mục
            $table->integer('price');
            $table->integer('discount_percent');
            $table->boolean('noi_bat');
            $table->timestamps();
            // Thiết lập khóa ngoại cho product_id liên kết với bảng products
            $table->foreign('cate_id')
                ->references('id')
                ->on('category')
                ->onDelete('restrict');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
