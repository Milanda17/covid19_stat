<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCovidDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('covid_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('update_date_time')->nullable();
            $table->string('local_new_cases')->nullable();
            $table->string('local_total_cases')->nullable();
            $table->string('local_total_number_of_individuals_in_hospitals')->nullable();
            $table->string('local_deaths')->nullable();
            $table->string('local_new_deaths')->nullable();
            $table->string('local_recovered')->nullable();
            $table->string('local_active_cases')->nullable();
            $table->string('global_new_cases')->nullable();
            $table->string('global_total_cases')->nullable();
            $table->string('global_deaths')->nullable();
            $table->string('global_new_deaths')->nullable();
            $table->string('global_recovered')->nullable();
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
        Schema::dropIfExists('COVID_DATA_TB');
    }
}
