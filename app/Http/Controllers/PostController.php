<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use\Auth;
use\App\Post;
use App\User;
use App\Comment;
use App\Profile;
use Illuminate\Support\Facades\DB;
use App\Like;
class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth'); 
    }


    public function index(){
        $users= auth::user()->following()->pluck('profiles.user_id');
        
        $posts=Post::whereIn('user_id',$users)->with('user','likes')->latest()->paginate(5);
        
            
            
        return view('posts.index', compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(){
        $data= request()->validate([
            'caption'=>'required',
            'image'=>['required','image']
        ]);
        $imagePath= request('image')->store('uploads','public');
        $image= Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        auth()->user()->posts()->create([
            'caption'=> $data['caption'],
            'image'=> $imagePath
        ]);
        return redirect('/profile/'.auth()->user()->id);
    }

    public function show(\App\Post $post){
        
        $comments=DB::table('users')
            ->join('comments','users.id','=','comments.user_id')
            ->join('profiles','profiles.user_id','=','users.id')
            ->where('comments.post_id','=',$post->id)
            ->orderBy('comments.id','DESC')->get();
            
            $user= $post->user()->first();
         
            $id=$user->id;

            $man= Profile::where('user_id',$id)->first();
            
            if ($man->image=='') {
                $image='profile/jnUIV75gXXB0KpaQ9lauyFe4uT2pjHQri7rZeII1.png';
            }
            else{
                $image=$man->image;
            }

            
            
        $commentCount= $post->comments()->count();
        
        

        return view('posts.show',compact(['post','comments','image','commentCount']));

    }




}
