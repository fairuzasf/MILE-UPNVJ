<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['event_id', 'user_id', 'status', 'reject_reason', 'attended'];
    protected function casts(): array
    {
        return ['attended' => 'boolean'];
    }
    
    public function event() { return $this->belongsTo(Event::class); }

    public function user()  { return $this->belongsTo(User::class); }
}