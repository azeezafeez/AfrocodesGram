<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Auth;


class Profile extends Model implements HasMedia
{

 use HasMediaTrait;
 protected $appends = ['image'];
protected $guarded=[];


public function followers(){
    return $this->belongsToMany(User::class);
}

public function profileImage(){

    //$imagePath=($this->image) ? '/storage/'.$this->image: 'images/faceless.png';
    $imagePath= $this->getFirstMediaUrl() ? $this->getFirstMediaUrl() : url("/").'/images/faceless.png';

    return $imagePath; 
}

public function user(){
    return $this->belongsTo(User::class);
}

public function getImageAttribute(){
	 return $this->getFirstMediaUrl();
	
}

}
 