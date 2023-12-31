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
        //Địa điểm du lịch
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//Tên quán, nhà hàng, khách sạn 
            $table->string('slug')->nullable();//slug (url)
            $table->string('thumnail')->nullable();//ảnh đại diện
            $table->string('slides')->nullable();//Slide ảnh
            $table->string('address')->nullable();//Địa chỉ~
            $table->string('type')->nullable();//Loại hình du lịch ()
            $table->text('description')->nullable();//Mô tả (Giới thiệu ngắn)
            $table->text('maps')->nullable();//iframe google map
            $table->longText('detail')->nullable();//Chi tiết cơ sở ẩm thực
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
        Schema::dropIfExists('locations');
    }
};
