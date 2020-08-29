<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title' , 'body' , 'user_id' ,'created_at','updated_at'
    ];
    protected $hidden=['created_at' , 'updated_at'];
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}

