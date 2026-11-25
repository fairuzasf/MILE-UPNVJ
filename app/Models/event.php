<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['title', 'description', 'type', 'starts_at', 'registration_deadline', 'quota', 'is_open'];

    protected function casts(): array
    {
        return ['starts_at' => 'datetime', 'registration_deadline' => 'datetime', 'is_open' => 'boolean'];
    }

    public function registrations() { return $this->hasMany(Registration::class); }
    public function announcements() { return $this->hasMany(Announcement::class); }
    public function permitLetters() { return $this->hasMany(Letter::class); }
    public function users()
    {
        return $this->belongsToMany(User::class, 'registrations')
                    ->withPivot('status', 'reject_reason', 'attended')
                    ->withTimestamps();
    }
}