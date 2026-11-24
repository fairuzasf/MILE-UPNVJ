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
        Schema::create('report_archives', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('category', 100)->nullable();             // mis. jenis laporan atau tema
                $table->unsignedSmallInteger('year');                    // tahun laporan
                $table->string('author_name')->nullable();               // nama kelompok/penulis lama
                $table->string('file_path');
                $table->string('original_name');
                $table->unsignedBigInteger('file_size')->nullable();
                $table->boolean('is_published')->default(true);          // admin bisa sembunyikan
                $table->unsignedInteger('download_count')->default(0);

                // opsional: arsip yang berasal dari laporan di sistem ini
                $table->foreignId('submission_id')->nullable()->constrained('submissions')->nullOnDelete();

                $table->foreignId('uploaded_by')->constrained('users')->cascadeOnDelete();
                $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_archives');
    }
};
