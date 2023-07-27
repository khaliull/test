<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePassedTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('passed_tests', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id');
          $table->foreignId('test_id');
          $table->boolean('finished')->default(false);
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('test_id')->references('id')->on('tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('passed_tests');
    }
}
