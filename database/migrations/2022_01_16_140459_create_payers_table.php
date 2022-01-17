<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payers', function (Blueprint $table) {
            $table->id('IdNguoiThanhToan');
            $table->string('HoTen');
            $table->string('GioiTinh');
            $table->string('Email');
            $table->string('SDT');
            $table->string('DiaChi');
            $table->string('QuocGia');
            $table->string('ThanhPho');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payers');
    }
}
