<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageWidthAndHeightToTrainingContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('training_contents', function (Blueprint $table) {
            $table->integer('file_image_width')->nullable();
            $table->integer('file_image_height')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_contents', function (Blueprint $table) {
            $table->dropColumn('file_image_width');
            $table->dropColumn('file_image_height');
        });
    }
}
