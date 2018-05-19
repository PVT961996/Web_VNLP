<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnFromOfferPosts extends Migration
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
            $table->dropColumn('short_description');
            $table->dropColumn('description');
            $table->dropColumn('offer_counts');
            $table->dropColumn('view_counts');
            $table->dropColumn('file');
            $table->dropColumn('link_download');
            $table->dropColumn('source');
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
    }
}
