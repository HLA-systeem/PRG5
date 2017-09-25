<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('creator_id')->default(1)->unsigned(); //haal de default later weg
            $table->mediumText('body');
            $table->bigInteger('times viewed')->default(0);
            $table->text('tags');
            $table->string('image1')->default("");
            $table->string('image2')->default("");
            $table->string('image3')->default("");
            $table->string('image4')->default("");
            $table->string('image5')->default("");
            $table->string('image6')->default("");
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
        Schema::dropIfExists('projects');
    }
}
