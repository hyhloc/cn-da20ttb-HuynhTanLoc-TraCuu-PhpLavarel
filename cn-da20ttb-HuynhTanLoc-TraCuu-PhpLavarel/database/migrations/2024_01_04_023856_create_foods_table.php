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
        //Dịch vụ ăn uống / ẩm thực
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('location_id')->default(0);
            $table->string('name');//Tên quán, nhà hàng, khách sạn 
            $table->string('slug')->nullable();//slug (url)
            $table->string('thumnail')->nullable();//ảnh đại diện
            $table->string('slides')->nullable();//Slide ảnh
            $table->string('phone')->nullable();//Số điện thoại
            $table->string('address')->nullable();//Địa chỉ
            $table->string('price')->nullable();//Giá dịch vụ
            $table->string('type')->nullable();//Loại hình (Quán ăn - Nhà hàng - Khách sạn)
            $table->string('times')->nullable();//Thời gian hoạt động
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
        Schema::dropIfExists('foods');
    }
};
