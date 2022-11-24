<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DjPasswordReset extends Model
{
    use HasFactory;
    protected $table = 'dj_reset_passwords';
}
