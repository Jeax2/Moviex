<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','plot','runtime','genre','released','actors','directors','poster','country','youtube','imdb_rating','category_id'];
    public function users() {
        return $this->belongToMany('App\Models\User');
    
    }
}
