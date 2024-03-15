<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'role',
        'password', // N'oubliez pas de spécifier le champ de mot de passe si vous utilisez l'authentification par mot de passe
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;
}
