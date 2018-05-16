<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOfferPostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('short_description');
            $table->text('description');
            $table->integer('offer_counts')->unsigned();
            $table->integer('view_counts')->unsigned();
            $table->string('file');
            $table->string('link_download');
            $table->string('source');
            $table->integer('post_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('post_id')->references('id')->on('documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('offer_posts');
    }
}
