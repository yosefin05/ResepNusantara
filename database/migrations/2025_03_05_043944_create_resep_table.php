<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reseps', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Judul resep
            $table->text('bahan'); // Bahan-bahan
            $table->text('langkah'); // Langkah-langkah
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // User yang mengupload
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reseps'); // Sesuai dengan nama tabel yang dibuat
    }
};
