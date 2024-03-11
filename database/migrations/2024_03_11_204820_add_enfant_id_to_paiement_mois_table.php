<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paiement_mois', function (Blueprint $table) {
        $table->unsignedBigInteger('enfant_id');

            $table->foreign('enfant_id')
                  ->references('id')
                  ->on('enfants')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paiement_mois', function (Blueprint $table) {
            $table->dropForeign(['enfant_id']);
            $table->dropColumn('enfant_id');   
             });
    }
};
