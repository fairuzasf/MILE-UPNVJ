<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'nim',
        'prodi',
        'email',
        'password',
    ];
    // 'role' sengaja tidak di fillable: diisi manual (login Google / seeder)

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function registrations() { return $this->hasMany(Registration::class); }
    public function submissions()   { return $this->hasMany(Submission::class); }
    public function letter() { return $this->hasMany(letter::class); }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'registrations')
                    ->withPivot('status', 'reject_reason', 'attended')
                    ->withTimestamps();
    }
    public function announcements()        { return $this->hasMany(Announcement::class, 'user_id'); }
    public function supervisedSubmissions() { return $this->hasMany(Submission::class, 'dosen_id'); }
    public function revisions()            { return $this->hasMany(Revision::class); }
    public function uploadedVersions()     { return $this->hasMany(SubmissionVersion::class, 'uploaded_by'); }

    public function isAdmin(): bool     { return $this->role === 'admin'; }
    public function isDosen(): bool     { return $this->role === 'dosen'; }
    public function isMahasiswa(): bool { return $this->role === 'mahasiswa'; }
}