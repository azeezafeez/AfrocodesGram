@extends('layouts.app')

@section('content')
<div class="container">
 <div class="col-md-6  offset-3 mb-3" id="result">
           
        </div>

<h1>Likes ({{$likes}})</h1>


@if(count($Likers)>0)
    @foreach ($Likers as $liker)

    <div class="row">
        <div class="col-md-6">
             <a href="/profile/{{$liker->id}}"><img src="{{$liker->user->profile->getFirstMediaUrl() ? $liker->user->profile->getFirstMediaUrl() : 'images/faceless.png' }}"  style="max-width: 250px" class="like-image" ></a>
                    
        </div>

        <div class="col-md-6">
            <div>
                <div  class="d-flex align-items-center">
                    <div class="pr-3">
                           <a href="/profile/{{$liker->id}}"><img src="{{$liker->user->profile->getFirstMediaUrl() ? $liker->user->profile->getFirstMediaUrl() : 'images/faceless.png' }}" class="rounded-circle w-100" style="max-width:40px"></a>
                     
                     </div>
                     <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$liker->id}} " style="text-decoration:none">
                            <span class="text-dark">{{$liker->user->username}}</span>
                            </a>
                           </div>
                    </div>
                </div>
                
                <p>
                     <span class="font-weight-bold">
                        <a href="/profile/{{$liker->id}} " style="text-decoration:none">
                            <span class="text-dark">{{$liker->user->username}}</span>
                        </a>
                     </span>
                     {{$liker->user->profile->description}}
                </p>
            </div>
        </div>
    </div>
    <hr>
    
    @endforeach
    @endif
     <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$Likers->links()}}
        </div>
    </div>

@endsection




