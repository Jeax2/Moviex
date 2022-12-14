<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentUser extends Model
{
    use HasFactory;
    protected $fillable = ['content_id', 'user_id'];
    protected $table = 'content_user';
}
