<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterClassNameSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_name_subjects', function (Blueprint $table) {
            $table->dropColumn('weekday');
            $table->dropColumn('start_time');
            $table->dropColumn('end_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_name_subjects', function (Blueprint $table) {
            $table->integer('weekday');
            $table->string('start_time');
            $table->string('end_time');
        });
    }
}
