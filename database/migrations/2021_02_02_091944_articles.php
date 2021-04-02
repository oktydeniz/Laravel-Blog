<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atricles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title');
            $table->string('image');
            $table->longText('content');
            $table->Integer('hit')->default(0);
            $table->Integer('status')->default(0)->comment("0:P 1:A");
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            //kategorinin id si bu tablodaki id degerini kategoriden alıcaz
            //ilişki kururuz kullanım sebebi : hataları azaltmak

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atricles');
    }
}
