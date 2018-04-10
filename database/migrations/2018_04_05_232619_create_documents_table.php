<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',[
                'Fluxogramas','Impressos','Manuais','Procedimentos','Sipoc'
            ]);
            $table->integer('discipline_id')->unsigned()->nullable();
            $table->foreign('discipline_id')
                ->references('id')
                ->on('disciplines')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('sub_discipline_id')->unsigned()->nullable();
            $table->foreign('sub_discipline_id')
                ->references('id')
                ->on('sub_disciplines')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('categorization_id')->unsigned()->nullable();
            $table->foreign('categorization_id')
                ->references('id')
                ->on('categorizations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('sequential')->nullable();
            $table->string('review')->nullable();
            $table->string('title')->nullable();
            $table->string('file');
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
        Schema::dropIfExists('documents');
    }
}
