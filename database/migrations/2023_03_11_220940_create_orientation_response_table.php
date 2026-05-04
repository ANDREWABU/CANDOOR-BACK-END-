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
        Schema::create('orientation_response', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('UserID');
            $table->json('response')->nullable();
            $table->json('scale')->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orientation_response');
    }
};
