<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $fillable = [
        'title', 'author', 'editorial',
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withPivot('user_id', 'loan_date');
    }
}
