<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionVersion extends Model
{
    protected $fillable = ['submission_id', 'version_number', 'file_path', 'original_name', 'note'];
    public function submission() { return $this->belongsTo(Submission::class); }

}
