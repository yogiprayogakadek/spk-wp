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
        Schema::create('rapat', function (Blueprint $table) {
            $table->id('id_rapat');
            $table->string('perihal_rapat', 100);
            $table->date('tanggal_rapat');
            $table->string('tempat_rapat', 100);
            $table->string('pimpinan_rapat', 100);
            $table->json('peserta_rapat')->nullable();
            $table->text('notulen')->nullable();
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
        Schema::dropIfExists('rapat');
    }
};
