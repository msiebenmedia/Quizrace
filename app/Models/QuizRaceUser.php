<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizRaceUser extends Model
{
    protected $fillable = [
        'mentix_user_id',
        'last_login_at',
    ];
}