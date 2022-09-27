<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 200)->comment('tên khách hàng');
            $table->string('phone', 200)->comment('số điện thoại');
            $table->string('email', 200)->comment('địa chỉ email');
            $table->string('address', 200)->comment('địa chỉ');
            $table->text('note')->comment('ghi chú')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
