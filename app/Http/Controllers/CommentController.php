<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;
use App\Comment;
use Illuminate\Support\Facades\DB;


class CommentController extends Controller
{
    public function comment(Post $post,$comment){
        if ($comment=='1') {
            # code...
        }
        else{
            $date=date('Y-m-d H:i a');
     
            $data=[
                'user_id'=>Auth::user()->id,
                'post_id'=>$post['id'],
                'time'=>$date,
                'comment'=>$comment
            ];
    
            $comment= new Comment;
    
            $comment->create($data);
    
            $comments=DB::table('users')
            ->join('comments','users.id','=','comments.user_id')
            ->join('profiles','profiles.user_id','=','users.id')
            ->where('comments.post_id','=',$post->id)
            ->orderBy('comments.id','DESC')->get();
    
            if ($comments==null) {
                return null;
            }
            else{
                return $comments;
            }
                
            
        }
        
    }

    public function getComments(Post $post){
        return $post->comments()->count();
    }

}
