<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $dateFormat = 'Y-m-d  g: a';


    public $timestamps=false;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(User::class);
    }
}
