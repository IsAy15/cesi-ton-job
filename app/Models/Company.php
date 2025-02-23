<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'sector',
        'localization',
    ];

    public $timestamps = false;

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
