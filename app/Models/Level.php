<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $table = 'levels';

    protected $fillable = [
        'title',
    ];

    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
