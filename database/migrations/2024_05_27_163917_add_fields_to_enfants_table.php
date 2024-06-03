<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToEnfantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enfants', function (Blueprint $table) {
            $table->string('caret_enfant')->nullable();
            $table->string('cin_parent')->nullable();
            $table->string('certif_enfant')->nullable();
            $table->string('extrait_de_naissance')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enfants', function (Blueprint $table) {
            $table->dropColumn('caret_enfant');
            $table->dropColumn('cin_parent');
            $table->dropColumn('certif_enfant');
            $table->dropColumn('extrait_de_naissance');
        });
    }
}
