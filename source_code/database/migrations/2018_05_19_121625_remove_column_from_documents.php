<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveColumnFromDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('documents', function($table) {
            $table->dropColumn('short_description');
            $table->dropColumn('slug');
            $table->dropColumn('comment_counts');
            $table->dropColumn('view_counts');
            $table->dropColumn('image');
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
