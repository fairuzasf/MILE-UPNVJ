<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class certificate extends Model
{
    protected $table = 'certificates';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['registration_id', 'code', 'issued_at'];
    protected function casts(): array { return ['issued_at' => 'datetime']; }
    public function registration() { return $this->belongsTo(Registration::class); }
}
