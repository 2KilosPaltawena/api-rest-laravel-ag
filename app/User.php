<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];

    protected $hidden =[
        'password',
        'remember_token',
    ];

    public $timestamps=false;
}
