<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Cache;

class FollowsController extends Controller
{

    public function __construct(){
        return $this->middleware('auth');
    }

    public function store(User $user){
        return auth()->user()->following()->toggle($user->profile);
    }   

    public function following($user){
        $users1=User::findOrfail($user);
        $users2= $users1->following()->pluck('profiles.user_id');
        $followings=User::whereIn('id',$users2)->orderBy('id','DESC')->paginate(5);
        return view('follows.following', compact('followings'));

       
    }

    public function followers($user){
        $users1=User::findOrfail($user);
        //$users2= $users1->profile->followers()->pluck('profiles.user_id');
        $followers=$users1->profile->followers()->orderBy('id','DESC')->paginate(5);
        return view('follows.followers', compact('followers'));

       
    }

    public function index(User $user)
    {
        
        $follows= (auth::user()) ? auth::user()->following->contains($user->id) : false;
      
       
        $postCount= Cache::remember(
            'count.posts'. $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
        });

        $followersCount= Cache::remember(
            'count.followers'. $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
        });

        $followingCount= Cache::remember(
                'count.following'. $user->id,
                now()->addSeconds(30),
                function () use ($user) {
                    return $user->following->count();
         });
    
         return [$followersCount,$followingCount];
        
     }
}
