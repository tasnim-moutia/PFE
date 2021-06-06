<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('echanges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('sentTo_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('annonce_id')->nullable()->constrained('annonces')->onDelete('cascade');
            $table->string('en_echange', 255)->nullable();
            $table->string('description', 500)->nullable();
            $table->string('image');
            $table->decimal('montant_supplémentaire')->nullable()->default(0.00);
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
        Schema::dropIfExists('echanges');
    }
}
