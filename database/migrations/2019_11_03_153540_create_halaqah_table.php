<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHalaqahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halaqah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->integer('user_id');
            $table->string('tiers', 20);
            $table->string('day', 10);
            $table->time('hour');
            $table->enum('gender', ['l', 'p']);
            $table->string('location', 50);
            $table->string('latitude', 100);
            $table->string('longitude', 100);
            $table->date('start_registration');
            $table->date('end_registration');
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
        Schema::dropIfExists('halaqah');
    }
}
