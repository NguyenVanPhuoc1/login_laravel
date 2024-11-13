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
        Schema::create('order_item', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id');
            $table->uuid('product_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();

            //thiết lập khóa ngoại
            $table->foreign('order_id')
                ->references('id')
                ->on('order')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            // Thiết lập khóa ngoại cho product_id liên kết với bảng products
            $table->foreign('product_id')
                ->references('id')
                ->on('product')      // Bảng `products`
                ->onUpdate('cascade') // Cập nhật tự động nếu ID sản phẩm thay đổi
                ->onDelete('restrict'); // Không xóa sản phẩm nếu có đơn hàng liên quan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item');
    }
};
