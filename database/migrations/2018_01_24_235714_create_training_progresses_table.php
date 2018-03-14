<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingProgressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_progress', function (Blueprint $table) {
            $table->uuid('training_progress_uuid');
            $table->uuid('training_contents_uuid');
            $table->uuid('user_uuid');
            $table->integer('video_last_location');
            $table->timestamps(); 
            $table->primary('training_progress_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_progress');
    }
}
