@extends('layouts.app')

@section('content')
<div class="container">
 <div class="col-md-6  offset-3 mb-3" id="result">
           
        </div>

<h1>Following ({{count($followings)}})</h1>


@if(count($followings)>0)
    @foreach ($followings as $following)
    <div class="row">
        <div class="col-md-6">
             <a href="/profile/{{$following->id}}"><img src="/storage/{{$following->profile->profileImage()}}" height="400" ></a>
                    
        </div>

        <div class="col-md-6">
            <div>
                <div  class="d-flex align-items-center">
                    <div class="pr-3">
                           <a href="/profile/{{$following->id}}"><img src="/storage/{{$following->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:40px"></a>
                     
                     </div>
                     <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$following->id}} " style="text-decoration:none">
                            <span class="text-dark">{{$following->username}}</span>
                            </a>
                           </div>
                    </div>
                </div>
                
                <p>
                     <span class="font-weight-bold">
                        <a href="/profile/{{$following->id}} " style="text-decoration:none">
                            <span class="text-dark">{{$following->username}}</span>
                        </a>
                     </span>
                     {{$following->profile->description}}
                </p>
            </div>
        </div>
    </div>
    <hr>
    
    @endforeach
    @endif
     <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$followings->links()}}
        </div>
    </div>

@endsection




