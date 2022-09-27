<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 200)->comment('mã danh mục');
            $table->string('name', 200)->comment('tên hạng mục');
            $table->string('link', 200)->comment('đường dẫn trên url');
            $table->integer('parent_id_1')->comment('danh mục level 1')->nullable();
            $table->integer('parent_id_2')->comment('danh mục level 2')->nullable();
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
        Schema::dropIfExists('categories');
    }
}
