<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_contents', function (Blueprint $table) {
            $table->uuid('training_contents_uuid');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_type');
            $table->string('target_type'); // sisters, elders, seniors, all - comma separate
            $table->integer('video_length');
            $table->timestamps();
            $table->primary('training_contents_uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_contents');
    }
}
