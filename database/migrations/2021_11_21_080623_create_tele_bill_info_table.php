<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeleBillInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tele_bill_info', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number');
            $table->string('status')->nullable();
            $table->string('bill_images')->nullable();
            $table->string('signature_images')->nullable();
            $table->string('agent_id')->nullable();
            $table->string('agent_name')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
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
        Schema::dropIfExists('tele_bill_info');
    }
}
