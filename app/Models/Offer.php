<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\User;

class Offer extends Model
{

    protected $table = 'offers';
    protected $fillable = [
        'title',
        'description',
        'localization',
        'starting_date',
        'ending_date',
        'places',
        'salary',
        'applies_count',
        'type',
        'created_at',
        'updated_at',
        'company_id',
        'promotion_id',
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'user_offer');
}

    public function wishlist()
    {
        return $this->belongsToMany(User::class, 'user_wishlist', 'offer_id', 'user_id')->withTimestamps();
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'offer_requirements', 'of_id', 'ab_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'offer_levels', 'offer_id', 'level_id');
    }

}
