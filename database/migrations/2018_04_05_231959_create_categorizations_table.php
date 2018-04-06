<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategorizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('discipline_id')->unsigned();
            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('sub_discipline_id')->unsigned();
            $table->foreign('sub_discipline_id')
                ->references('id')
                ->on('sub_disciplines')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('categorizations');
    }
}
