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
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->bigIncrements('WorkExperienceID');
            $table->string('AdviseeID')->nullable();
            $table->string('AdvisorID')->nullable();
            $table->string('company')->nullable();
            $table->timestamp('Created_timestamp_EST')->nullable();
            $table->string('employment_type')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('industry')->nullable();
            $table->boolean('is_current')->default(false);
            $table->timestamp('Modified_timestamp_EST')->nullable();
            $table->integer('recency')->nullable();
            $table->string('role')->nullable();
            $table->string('title')->nullable();
            $table->string('UserID')->nullable();
            $table->text('ask_me_about')->nullable();
            $table->string('employment_type_other')->nullable();
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
        Schema::dropIfExists('work_experiences');
    }
};
