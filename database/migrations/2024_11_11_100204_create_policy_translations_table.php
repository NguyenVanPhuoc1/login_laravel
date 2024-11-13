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
        Schema::create('policy_translations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('poli_id');
            $table->string('language_code')->default('vi');
            $table->string('poli_name');//tên chính sách
            $table->text('poli_desc')->nullable();//mô tả
            $table->timestamps();

            // Thiết lập khóa ngoại cho product_id
            $table->foreign('poli_id')
                ->references('id')
                ->on('policy')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_translations');
    }
};
