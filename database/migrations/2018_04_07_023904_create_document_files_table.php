<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentFilesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('file_id')->unsigned();
            $table->integer('document_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('document_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('document_files');
    }
}
