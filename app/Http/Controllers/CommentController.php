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
            
            $data=[
                'user_id'=>Auth::user()->id,
                'post_id'=>$post['id'],
                'comment'=>$comment
            ];
    
            $comment= new Comment;
    
            $comment->create($data);

            $comments= Comment::where('post_id','=',$post->id)->with('user.profile')->orderBy('comments.id','DESC')->get();


            
            

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
