<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportArchive extends Model
{
    protected $fillable = [
        'title',
        'description',
        'category',
        'year',
        'author_name',
        'file_path',
        'original_name',
        'file_size',
        'is_published',
        'submission_id',
        'uploaded_by',
    ];

    protected function casts(): array
    {
        return [
            'year'         => 'integer',
            'is_published' => 'boolean',
        ];
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }

    // Untuk halaman arsip mahasiswa: hanya yang dipublikasikan
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }
}