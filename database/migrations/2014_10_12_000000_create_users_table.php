<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kontak_id')->index();
            $table->foreign('kontak_id')->references('id')->on('kontaks')->onUpdate('cascade')->onDelete('restrict')->uniqid()->unsigned();
            $table->string('name');
            $table->string('email')->unique();
            $table->ipAddress('ip_access');
            //$table->macAddress('mac_access');
            $table->string('create_by');
            $table->string('update_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
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
