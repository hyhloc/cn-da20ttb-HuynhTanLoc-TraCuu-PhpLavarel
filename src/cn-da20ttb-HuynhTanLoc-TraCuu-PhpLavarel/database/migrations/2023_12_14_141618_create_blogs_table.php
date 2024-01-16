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
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->default(0);
            $table->string('name');//Tên bài viết
            $table->string('slug')->nullable();//slug
            $table->string('thumnail')->nullable();//ảnh đại diện
            $table->text('description')->nullable();//Mô tả
            $table->longText('detail')->nullable();//Chi tiết bài viết

            $table->tinyInteger('status')->nullable();
            $table->unique('id','id_UNIQUE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
