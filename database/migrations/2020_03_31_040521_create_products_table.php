<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 100)->comment('Mã sản phẩm');
            $table->string('name', 100)->comment('tên sản phẩm');
            $table->string('link', 100)->comment('đường dẫn trên url');
            $table->integer('category_id')->comment('hạng mục level 1')->nullable();
            $table->integer('category_id_2')->comment('hạng mục level 2')->nullable();
            $table->integer('category_id_3')->comment('hạng mục con')->nullable();
            $table->string('avatar1', 255)->comment('ảnh đại diện 1')->nullable();
            $table->string('avatar2', 255)->comment('ảnh đại diện 2')->nullable();
            $table->string('avatar3', 255)->comment('ảnh đại diện 3')->nullable();
            $table->string('avatar4', 255)->comment('ảnh đại diện 4')->nullable();
            $table->string('avatar5', 255)->comment('ảnh đại diện 5')->nullable();
            $table->string('avatar6', 255)->comment('ảnh đại diện 6')->nullable();
            $table->string('avatar7', 255)->comment('ảnh đại diện 7')->nullable();
            $table->string('avatar8', 255)->comment('ảnh đại diện 8')->nullable();
            $table->text('detail')->comment('chi tiết sản phẩm')->nullable();
            $table->text('procedure')->comment('quy cách')->nullable();
            $table->string('warranty', 255)->comment('bảo hành')->nullable();
            $table->float('unit_price',50,2)->comment('đơn giá')->nullable();
            $table->float('promotion_price', 50, 2)->comment('giá khuyến mãi')->nullable();
            $table->integer('count')->comment('số lượng hàng')->nullable();
            $table->tinyInteger('status')->comment('trạng thái của sản phẩm, đang bán hay không')->nullable();
            $table->tinyInteger('price_applied')->comment('bán theo đơn giá hay giá khuyến mãi')->nullable();
            $table->tinyInteger('is_new')->comment('hàng mới hay cũ')->nullable();
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
        Schema::dropIfExists('products');
    }
}
