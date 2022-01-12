<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id('IdChuyenBay');
            $table->string('HangHK');
            $table->string('SHMayBay');
            $table->string('ThoiGianKhoiHanh');
            $table->string('ThoiGianHaCanh');
            $table->string('DiaDiemKhoiHanh');
            $table->string('DiaDiemHaCanh');
            $table->string('LoaiHinhBay');
            $table->integer('TongSoVe');
            $table->integer('SLVeConLai');
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
        Schema::dropIfExists('flights');
    }
}
