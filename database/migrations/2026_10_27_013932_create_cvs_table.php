<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('cvs', function (Blueprint $table) {
        $table->id();
        $table->string('nama');
        $table->string('jabatan');
        $table->text('ringkasan')->nullable();
        $table->string('email')->nullable();
        $table->string('telepon')->nullable();
        $table->string('alamat')->nullable();
        $table->string('website')->nullable();
        $table->text('pendidikan')->nullable();
        $table->text('pengalaman')->nullable();
        $table->text('skill')->nullable();
        $table->text('sertifikasi')->nullable();
        $table->string('foto')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cvs');
    }
};
