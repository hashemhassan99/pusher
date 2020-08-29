<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   protected $fillable = [
       'post_id' , 'user_id' , 'comment','created_at','updated_at'
   ];
    protected $hidden=['created_at' , 'updated_at'];
    public $timestamps = true;
    public function user(){
        return $this->belongsTo(User::class);
    }
}
