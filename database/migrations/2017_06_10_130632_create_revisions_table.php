<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('description');
            $table->integer('elaborate')->nullable()->unsigned();
            $table->integer('reviewed')->nullable()->unsigned();
            $table->integer('approved')->nullable()->unsigned();
            $table->dateTime('elaborate_date')->nullable();
            $table->dateTime('reviewed_date')->nullable();
            $table->dateTime('approved_date')->nullable();
            $table->integer('version')->unsigned();
            $table->integer('procedures_id')->unsigned();

            $table->foreign('elaborate')
                ->references('id')
                ->on('users');

            $table->foreign('reviewed')
                ->references('id')
                ->on('users');

            $table->foreign('approved')
                ->references('id')
                ->on('users');

            $table->foreign('procedures_id')
                ->references('id')
                ->on('procedures')
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
        Schema::dropIfExists('revisions');
    }
}
