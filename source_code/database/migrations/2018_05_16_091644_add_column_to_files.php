<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('files', function($table) {
            $table->integer('like')->nullable()->default(0);
            $table->integer('dislike')->nullable()->default(0);
            $table->integer('neutral')->nullable()->default(0);
            $table->dropColumn('evaluated');
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
        Schema::table('files', function($table) {
            $table->dropColumn('like');
            $table->dropColumn('dislike');
            $table->dropColumn('neutral');
        });
    }
}
