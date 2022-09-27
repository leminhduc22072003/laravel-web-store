<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('username');
            $table->string('name');
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('auth_token')->nullable();
            $table->dateTime('last_action')->nullable();
            $table->string('extra_token')->nullable();
            $table->tinyInteger('group')->default(1);
            $table->string('phone')->nullable();
            $table->tinyInteger('active')->default(0);
            $table->tinyInteger('gender')->nullable();
            $table->timestamps();
        });

        \App\Models\User::create
        ([
            'email' => 'test@gmail.com',
            'name' => 'Test Administrator',
            'username' => 'admin',
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'group' => GROUP_ADMIN,
            'active' => ACTIVE_TRUE
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
