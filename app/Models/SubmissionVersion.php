<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionVersion extends Model
{
    protected $table = 'submission_version';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['submission_id', 'version_number', 'file_path', 'original_name', 'file_size', 'note', 'uploaded_by'];

    public function submission() { return $this->belongsTo(Submission::class); }
    public function uploader()   { return $this->belongsTo(User::class, 'uploaded_by'); }
}