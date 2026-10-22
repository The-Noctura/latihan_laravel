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
    Schema::create('siswas', function (Blueprint $table) {
      $table->id();
      $table->string('nisn', 10)->unique();
      $table->string('nama', 100);
      $table->enum('jenis_kelamin', ['L', 'P']);
      $table->string('jurusan')->default('RPL');
      $table->text('alamat')->nullable();
      $table->string('email')->unique()->nullable();
      $table->string('nomor_telepon', 12);
      $table->string('tempat_lahir');
      $table->date('tanggal_lahir');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('siswas');
  }
};
