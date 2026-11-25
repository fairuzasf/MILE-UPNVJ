<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    protected $fillable = ['title', 'type', 'due_at', 'reminder_sent_at'];

    protected function casts(): array
    {
        return ['due_at' => 'datetime', 'reminder_sent_at' => 'datetime'];
    }

    public function submissions() { return $this->hasMany(Submission::class); }
}