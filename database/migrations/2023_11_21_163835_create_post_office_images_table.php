<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostOfficeImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_office_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_office_id')->nullable();
            $table->string('file')->nullable();
            $table->string('type')->nullable();
            $table->float('distance')->nullable();
            $table->timestamps();
            $table->foreign('post_office_id')->on('post_offices')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_office_images');
    }
}
