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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id('id_nilai');
            $table->foreignId('id_alternatif')->references('id_alternatif')->on('alternatif')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_kriteria')->references('id_kriteria')->on('kriteria')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('nilai')->default(0);
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
        Schema::dropIfExists('nilai');
    }
};
