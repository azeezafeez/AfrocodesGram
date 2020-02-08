<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
protected $guarded=[];


public function followers(){
    return $this->belongsToMany(User::class);
}

public function profileImage(){

    $imagePath=($this->image) ? $this->image: 'profile/jnUIV75gXXB0KpaQ9lauyFe4uT2pjHQri7rZeII1.png';
    return $imagePath; 
}

public function user(){
    return $this->belongsTo(User::class);
}
}
 