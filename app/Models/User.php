<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'user_lastname',
        'user_firstname',
        'user_email',
        'user_role',
    ];

    protected $primaryKey = 'user_id';
    public $timestamps = false;
}
