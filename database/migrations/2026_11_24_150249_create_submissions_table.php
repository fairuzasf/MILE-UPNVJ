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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('dosen_id')->constrained('users');
            $table->foreignId('deadline_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title');
            $table->string('type'); // proposal | laporan_akhir
            $table->string('status')->default('dikirim'); // dikirim|direvisi|disetujui
            $table->unsignedInteger('current_version')->default(1);
            $table->boolean('is_archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
