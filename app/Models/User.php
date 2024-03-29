<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Promotion;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'role',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'user_promotions', 'user_id', 'promotion_id');
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'applications');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Offer::class, 'user_wishlist', 'user_id', 'offer_id');
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'student_abilities', 'user_id', 'ability_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    

}
