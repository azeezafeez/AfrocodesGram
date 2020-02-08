<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use App\Like;
use App\User;
use App\Comment;
use Auth;
class Post extends Model
{


    // do not guard any variable
    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);   
    }
    
     public function likes(){
        return $this->hasMany(Like::class);   
     }

     public function getStatus($postId){
        $likes = Like::select('status')->where('user_id',Auth::user()->id)
        ->where('post_id', $postId)
        ->get()->toArray();
        
        if ($likes) {
            for ($i=0; $i <count($likes) ; $i++) { 
                $status=$likes[$i]['status'];
                if ($status==1) {
                    return true;
                }
                else{
                    return false;
                }
           }
   
        }
        else{
            return false;
        }
                
     }

     public function getLikes($postId){
        $likes = Like::where('post_id', $postId)
        ->where('status',1)
        ->count();
       return $likes;
           
     }

    
     public function getComments($post){
        $posts=Comment::where('post_id',$post)->get()->count();
        return $posts;
    }


}


