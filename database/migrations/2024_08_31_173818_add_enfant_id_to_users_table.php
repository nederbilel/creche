<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEnfantIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('enfant_id')->nullable(); // Add the column (nullable if not all users have an enfant)

            $table->foreign('enfant_id') // Define the foreign key constraint
                  ->references('id')
                  ->on('enfants') // Assumes the related table is 'enfants'
                  ->onDelete('cascade'); // Optional: decide what happens on delete (cascade, set null, etc.)
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
            $table->dropForeign(['enfant_id']); // Drop the foreign key constraint first
            $table->dropColumn('enfant_id'); // Then drop the column
        });
    }
}
