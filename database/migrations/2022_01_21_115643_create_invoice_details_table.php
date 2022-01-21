<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id('IdChiTietHoaDon');
            $table->float('Thue')->nullable();
            $table->float('ThanhTien');
            $table->float('HLKG')->nullable();
            $table->boolean('DVBS')->nullable();
            $table->integer('IdVeMayBay');
            $table->integer('IdHanhKhach');
            $table->integer('IdHoaDon');
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
        Schema::dropIfExists('invoice_details');
    }
}