<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableContent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('summary')->nullable();
            $table->string('slug')->nullable();
            $table->string('id_penulis')->nullable();
            $table->integer('id_topics')->nullable();
            $table->integer('id_image_cover')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('status');
            $table->integer('tipe');
            $table->integer('count_view');
            $table->text('body')->nullable();
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
        //
          Schema::drop('content');
    }
}
