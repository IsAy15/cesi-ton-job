<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{
    use HasFactory;

    protected $table = 'abilities';

    protected $fillable = [
        'title',
        'description',
    ];

    protected $primaryKey = 'id';
    
    public $timestamps = false;

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'offer_requirements', 'of_id', 'ab_id');
    }

}
