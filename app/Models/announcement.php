<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = ['user_id', 'event_id', 'title', 'body'];

    public function author() { return $this->belongsTo(User::class, 'user_id'); }
    public function event()  { return $this->belongsTo(Event::class); }
}