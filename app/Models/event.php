<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = ['title', 'description', 'type', 'starts_at', 'registration_deadline', 'quota', 'is_open'];
    protected function casts(): array
    {
        return ['starts_at' => 'datetime', 'registration_deadline' => 'datetime', 'is_open' => 'boolean'];
    }
    public function registrations() { return $this->hasMany(Registration::class); }
    public function announcements() { return $this->hasMany(Announcement::class); }

}
