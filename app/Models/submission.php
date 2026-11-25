<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submissiosn';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['user_id', 'dosen_id', 'deadline_id', 
    'title', 'type', 'status', 'current_version', 'is_archived'];

    protected function casts(): array { return ['is_archived' => 'boolean']; }

    public function user()          { return $this->belongsTo(User::class); }
    public function dosen()         { return $this->belongsTo(User::class, 'dosen_id'); }
    public function deadline()      { return $this->belongsTo(Deadline::class); }
    public function versions()      { return $this->hasMany(SubmissionVersion::class); }
    public function latestVersion() { return $this->hasOne(SubmissionVersion::class)->latestOfMany('version_number'); }
    public function revisions()     { return $this->hasMany(Revision::class); }
}