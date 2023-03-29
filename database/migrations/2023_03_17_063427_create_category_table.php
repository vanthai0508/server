<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('teacher')->nullable(true);
            $table->integer('number_video')->nullable(true);
            $table->float('rate')->nullable(true);
            $table->integer('number_registered')->default(0);
            $table->bigInteger('price')->nullable(true);
            $table->integer('status')->default(0);
            $table->string('path');
            $table->longText('description')->nullable(true);
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
        Schema::dropIfExists('category');
    }
}
