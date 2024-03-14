<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'lastname',
        'firstname',
        'email',
        'role',
    ];

    protected $primaryKey = 'id';
    public $timestamps = false;
}
