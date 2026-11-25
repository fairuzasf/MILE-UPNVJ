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
        Schema::create('deadlines', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // mis. "Pengumpulan Proposal PJBL"
            $table->string('type');  // proposal | laporan_akhir | kegiatan
            $table->dateTime('due_at');
            $table->timestamp('reminder_sent_at')->nullable(); // supaya email pengingat tidak terkirim dua kali
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deadlines');
    }
};
