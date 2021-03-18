@extends('layouts.app')

@section('content')
<div class="container">
 <div class="col-md-6  offset-3 mb-3" id="result">
           
</div>
    <div class="row">
        <div class="col-md-4 p-5">
           
            <img src="{{$user->profile->profileImage()}}" class="rounded-circle w-70" height="200">
        </div>
        <div class="col-md-8 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <h1 class="profile-name">{{$user->username}}</h1>
                    @if(Auth::user()->id!=$user->id)
                        <div class="follow-button"><follow-button user-id="{{ $user->id}}" follows="{{$follows}}"></follow-button></div>   
                    @endif
                    
                </div>
                        
                  @can('update', $user->profile)
                      <a href="{{route('post.create')}}" ><button class="btn btn-primary btn-sm">Add New Post</button></a>
              
                  @endcan
              </div>
                @can('update', $user->profile)
                    <a href="/profile/{{$user->id}}/edit" ><button class="btn btn-success btn-sm mb-2">Edit Profile</button></a>
            
                @endcan
                <input type="hidden" id="user" value="{{$user->id}}">
            <div class="d-flex">
                <div class="pr-5"><strong>{{$postCount}} </strong>posts</div>
                <div class="pr-5" ><strong><span id="followers">  {{$followersCount}}</span> </strong> followers
                @if($followersCount==0)
                    
                @else
                    <a href="/follower/{{$user->id}}" class="badge btn btn-success ">view</a>
                    
                @endif   
                </div>
                <div class="pr-5"><strong><span id="followings">  {{$followingCount}}</span> </strong>  following 
                @if($followingCount==0)
                    
                @else
                     <a href="/following/{{$user->id}}"  class="badge btn btn-success">view</a>
                    
                @endif 
                 </div>
                 
            </div>
            <div class="pt-4 font-weight-bold">{{$user->profile->title}}</div>
            <span class="font-weight-bold">Bio</span>
            <div>{{$user->profile->description}}</div>
            <div><a href="{{$user->profile->url ?? '#'}}"   style="text-decoration:none"  >{{$user->profile->url ?? 'N/A'}}</a></div>

        </div>
    </div>
    <div class="row pt-5 ">
        @foreach($user->posts as $post)
            <div class="col-md-4 pb-4 row-profile">
            <a href="{{route('post.show',['post'=> $post->id])}}">
                <img src="{{$post->image}}" class="w-100 img-profile">
            </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
