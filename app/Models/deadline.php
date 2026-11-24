<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class deadline extends Model
{
    protected $fillable = ['title', 'type', 'due_at'];
    protected function casts(): array { return ['due_at' => 'datetime']; }
    public function submissions() { return $this->hasMany(Submission::class); }
}
