<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    protected $fillable = [
        'fullname',
        'username',
        'email',
        'password',
        'avatar',
        'role',
        'active',

    ];
}
