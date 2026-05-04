<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_backgrounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('time_zone')->nullable();
            $table->string('gender')->nullable();
            $table->longText('extra_info')->nullable();
            $table->json('race')->nullable();
            $table->json('belongs_to')->nullable();
            $table->string('UserID');
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
        Schema::dropIfExists('user_backgrounds');
    }
};
