<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_type')->default('normal')->comment('normal','premium');
            $table->string('name_of_vaccine')->nullable();
            $table->string('date_of_first_dose')->nullable();
            $table->string('date_of_second_dose')->nullable();
            $table->string('date_of_registration')->nullable();
            $table->string('antibody_last_date')->nullable();
            $table->enum('status', [0,1]);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('center_id')->nullable();
            $table->unsignedBigInteger('first_served_by_id')->nullable();
            $table->unsignedBigInteger('second_served_by_id')->nullable();
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
        Schema::dropIfExists('vaccinations');
    }
}
