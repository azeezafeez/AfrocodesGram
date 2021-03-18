<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use\Auth;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    
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

         

        return view('profiles.index', compact('user','follows','postCount','followersCount','followingCount'));
    }

    public function edit(User $user){
        $this->authorize('update',$user->profile);
        return view('profiles.edit', compact('user'));
    }

    public function update(User $user){

    
        $this->authorize('update',$user->profile);
        $data= request()->validate([
            'title'=>'required',
            'description'=>'required',
            'url'=>'url',
           
        ]);


        if (request('image')) {
              
              if (auth()->user()->profile->image!=null) {
                  (auth()->user()->profile->getMedia())[0]->delete();
                    
              }

              auth()->user()->profile->addMediaFromRequest('image')->toMediaCollection();
        }

        auth()->user()->profile->update(array_merge(
            $data
              
        ));
        
        return redirect("/profile/{$user->id}");
       
    }

    public function hey(){
        return auth()->user()->profile->getFirstMediaUrl() ? auth()->user()->profile->getFirstMediaUrl(): "no media" ;    
    }
}
  

