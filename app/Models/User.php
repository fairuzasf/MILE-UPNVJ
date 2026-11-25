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
    public function permitLetters() { return $this->hasMany(PermitLetter::class); }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'registrations')
                    ->withPivot('status', 'reject_reason', 'attended')
                    ->withTimestamps();
    }

    public function isAdmin(): bool     { return $this->role === 'admin'; }
    public function isDosen(): bool     { return $this->role === 'dosen'; }
    public function isMahasiswa(): bool { return $this->role === 'mahasiswa'; }
}