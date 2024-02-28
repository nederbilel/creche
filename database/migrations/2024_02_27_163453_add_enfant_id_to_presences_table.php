<?php

// database/migrations/{timestamp}_add_enfant_id_to_presences_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnfantIdToPresencesTable extends Migration
{
    public function up()
    {
        Schema::table('presences', function (Blueprint $table) {
            // $table->unsignedBigInteger('enfant_id');

            // $table->foreign('enfant_id')
            //       ->references('id')
            //       ->on('enfants')
            //       ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('presences', function (Blueprint $table) {
            $table->dropForeign(['enfant_id']);
            $table->dropColumn('enfant_id');
        });
    }
}
