<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'personal_number',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


}
