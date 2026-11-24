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
        Schema::create('permit_letters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();           // pemohon
            $table->foreignId('event_id')->nullable()->constrained('events')->nullOnDelete();
            $table->string('type', 50);                                               // jenis izin
            $table->text('reason');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status', 20)->default('submitted');                       // submitted|approved|rejected
            $table->text('rejection_note')->nullable();

            // diisi saat disetujui (tanda tangan digital)
            $table->string('letter_number')->nullable()->unique();
            $table->foreignId('signed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->dateTime('signed_at')->nullable();
            $table->string('verification_code', 64)->nullable()->unique();            // isi QR
            $table->string('letter_hash', 64)->nullable();                            // sha256 isi surat
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letters');
    }
};
