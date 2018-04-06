<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function($table) {
            $table->integer('group_id')->unsigned();
            $table->string('avatar')->nullable();
            $table->integer('age')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('address')->nullable();
            $table->integer('sex')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('group_id');
            $table->dropColumn('avatar');
            $table->dropColumn('age');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('sex');
        });
    }
}
