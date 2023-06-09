<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('FILE_NAME');
            $table->string('FILE_DESCRIPTION');
            $table->string('STATUS');
            $table->unsignedBigInteger('correspondence_id');
            $table->foreign('correspondence_id')->references('id')->on('correspondences')->onDelete('cascade');
            $table->timestamps();
        });

        // Schema::create('files', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('FILE_NAME');
        //     $table->string('FILE_DESCRIPTION');
        //     $table->boolean('STATUS');
        //     $table->foreignId('correspondence_id')
        //           ->onUpdate('cascade')
        //           ->onDelete('cascade')
        //           ->constrained();
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
