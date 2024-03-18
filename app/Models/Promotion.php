<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $table = 'promotions';

    protected $fillable = [
        'name',
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_promotions', 'promotion_id', 'user_id');
    }
}
