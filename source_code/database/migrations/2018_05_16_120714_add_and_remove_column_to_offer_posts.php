<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAndRemoveColumnToOfferPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('offer_posts', function($table) {
            $table->dropForeign(['document_id']);
            $table->dropColumn('document_id');
            $table->integer('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('files');
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
        Schema::table('offer_posts', function (Blueprint $table) {
            $table->dropColumn('file_id');
        });
    }
}
