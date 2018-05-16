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
            $table->integer('evaluated')->nullable();
            $table->float('point')->nullable();
        });
        Schema::table('sentences', function($table) {
            $table->integer('evaluated')->nullable();
            $table->float('point')->nullable();
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
            $table->dropColumn('evaluated');
            $table->dropColumn('point');
        });
        Schema::table('sentences', function($table) {
            $table->dropColumn('evaluated');
            $table->dropColumn('point');
        });
    }
}
