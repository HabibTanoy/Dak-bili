<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThanaDivisionDistrictAddressFieldIntoPostOfficeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_offices', function (Blueprint $table) {
            $table->string('division')->nullable();
            $table->string('district')->nullable();
            $table->string('sub_district')->nullable();
            $table->text('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_offices', function (Blueprint $table) {
            //
        });
    }
}
