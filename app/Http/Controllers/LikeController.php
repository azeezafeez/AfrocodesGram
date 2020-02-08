<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Post;
use App\Like;
use Auth;
use App\User;
use App\Profile;

use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function like($post){

        $responseArray=array();

        $likes = Like::select('status','id')->where('user_id',Auth::user()->id)
        ->where('post_id', $post)
        ->get()->toArray();
        
        for ($i=0; $i <count($likes) ; $i++) { 
             $id= $likes[$i]['id'];
             $status=$likes[$i]['status'];
             
        }

        
        
        if ($likes) {
            if ($status==0) {
                $like=  Like::findOrFail($id);
                $like->status=1;
                $like->save();
                array_push($responseArray,1);
            }
            else{
                $like=Like::findOrFail($id);
                $like->status=0;
                $like->save();
                array_push($responseArray,0);
            
            }
            
        }
        
        else{
            $like= new Like;
            $like->user_id= Auth::user()->id;
            $like->post_id=$post;
            $like->status=1;
            $like->save();
            array_push($responseArray,1);
            
           
        }

       
      
        
        
        

        return $responseArray;
    }

    public function getlike($postId){
        $likes = Like::where('post_id', $postId)
        ->where('status',1)
        ->count();
        return $likes;
    }


    public function getLiker($postId){
        $Likers=DB::table('users')
        ->join('likes','users.id','=','likes.user_id')
        ->join('profiles','profiles.user_id','=','users.id')
        ->where('likes.post_id','=',$postId)
        ->where('likes.status','=',1)
        ->orderBy('likes.id','DESC')->paginate(5);

        $likes = Like::where('post_id', $postId)
        ->where('status',1)
        ->count();
       
        
    return view('posts.likers', compact(['likes','Likers']));
    }
}
