<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

trait LikableTrait 
{
    public function likes(){
        return $this->morphMany(Like::class,'Likable');
    }

    public function likeit(){
        $like= new Like();
        $like->user_id=auth()->user()->id;
        $this->likes()->save($like);
        return $like;
    }

}
