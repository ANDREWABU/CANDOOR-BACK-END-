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
        Schema::create('education_experiences', function (Blueprint $table) {
            $table->bigIncrements('EducationExperienceID');
            $table->string('AdviseeID')->nullable();
            $table->string('AdvisorID')->nullable();
            $table->timestamp('Created_timestamp_EST')->nullable();
            $table->string('degree')->nullable();
            $table->json('fields_of_study')->nullable();
            $table->timestamp('graduation_year')->nullable();
            $table->timestamp('Modified_timestamp_EST')->nullable();
            $table->integer('recency')->nullable();
            $table->string('school')->nullable();
            $table->string('UserID')->nullable();
            $table->text('ask_me_about')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->boolean('is_current')->default(false);
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
        Schema::dropIfExists('education_experiences');
    }
};
