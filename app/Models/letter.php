<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class letter extends Model
{
    protected $table = 'permit_letters';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'event_id',
        'type',
        'reason',
        'start_date',
        'end_date',
    ];
    // Kolom status, letter_number, signed_by, signed_at, verification_code,
    // letter_hash, pdf_path sengaja tidak di fillable agar diisi oleh sistem
    // saat persetujuan, bukan dari input form pemohon.

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date'   => 'date',
            'signed_at'  => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function signer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'signed_by');
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}