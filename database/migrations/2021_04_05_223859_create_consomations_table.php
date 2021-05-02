<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsomationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consomations', function (Blueprint $table) {

            $table->id();
            $table->string('mois');
            $table->integer('annee');
            $table->float('consomation');
            $table->float('prixHT');
            $table->float('TVA');
            $table->float('prixTTC');
            $table->boolean('status');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
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
        Schema::dropIfExists('consomations');
    }
}
