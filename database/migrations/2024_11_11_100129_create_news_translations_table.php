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
        Schema::create('news_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('news_id');
            $table->string('language_code')->default('vi');
            $table->string('news_name');
            $table->text('news_desc')->nullable();//mô tả
            $table->timestamps();

            // Thiết lập khóa ngoại cho product_id
            $table->foreign('news_id')
                ->references('id')
                ->on('news')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_translations');
    }
};
