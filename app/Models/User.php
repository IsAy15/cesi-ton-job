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

    public function appliedOffers()
    {
        return $this->belongsToMany(Offer::class, 'user_offer', 'user_id', 'offer_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Offer::class, 'user_wishlist', 'user_id', 'offer_id');
    }

}
