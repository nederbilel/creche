<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPicturePathToEnfantsTable extends Migration
{
    public function up()
    {
        Schema::table('enfants', function (Blueprint $table) {
            // Add a column to store the picture path
            $table->string('picture_path')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('enfants', function (Blueprint $table) {
            // Drop the picture path column if the migration is rolled back
            $table->dropColumn('picture_path');
        });
    }
}
