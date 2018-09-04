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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('biograph')->nullable();
            $table->enum('status', ['Safe', 'Unsafe', 'Blocked'])->nullable();
            $table->string('akses')->default('User');
            $table->string('imageprofile')->default('default.jpg');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'name' => "Sendii",
            'email' => "Sendii@gmail.com",
            'password' => bcrypt("888888"),
            'biograph' => "Ini biografi kuu",
            'status' => "Safe",
            'akses' => "Admin"
        ]);
        DB::table('users')->insert([
            'name' => "member2",
            'email' => "member2@member2.com",
            'password' => bcrypt("member2"),
            'biograph' => "Ini biografi kuu2",
            'status' => "Safe",
            'akses' => "User"
        ]);
        DB::table('users')->insert([
            'name' => "member3",
            'email' => "member3@member3.com",
            'password' => bcrypt("member3"),
            'biograph' => "Ini biografi kuu3",
            'status' => "Safe",
            'akses' => "User"
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
