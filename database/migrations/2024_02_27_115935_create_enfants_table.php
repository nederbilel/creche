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
        Schema::create('enfants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('date_de_naissance');
            $table->string('nom_mere');
            $table->string('nom_pere');
            $table->string('travail_pere');
            $table->string('travail_mere');
            $table->string('vaccin');
            $table->string('adresse');
            $table->string('maladie');
            $table->string('description');
            $table->string('telephone1')->nullable();
            $table->string('telephone2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enfants');
    }
};
