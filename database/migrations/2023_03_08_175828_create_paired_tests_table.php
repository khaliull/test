<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePairedTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paired_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('first_user_id');
            $table->foreignId('second_user_id')->nullable();
            $table->foreignId('test_id');
            $table->string('key')->unique();
            $table->foreignId('first_passed_test_id')->nullable();
            $table->foreignId('second_passed_test_id')->nullable();
            $table->boolean('first_finished')->default(false);
            $table->boolean('second_finished')->default(false);
            $table->boolean('finished')->default(false);
            $table->timestamps();

            $table->foreign('first_user_id')->references('id')->on('users');
            $table->foreign('second_user_id')->references('id')->on('users');
            $table->foreign('first_passed_test_id')->references('id')->on('passed_tests');
            $table->foreign('second_passed_test_id')->references('id')->on('passed_tests');
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
        Schema::dropIfExists('paired_tests');
    }
}
