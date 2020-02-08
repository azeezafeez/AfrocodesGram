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
             <a href="/profile/{{$liker->id}}"><img src="/storage/{{$liker->image ? $liker->image : 'profile/jnUIV75gXXB0KpaQ9lauyFe4uT2pjHQri7rZeII1.png' }}" height="400" ></a>
                    
        </div>

        <div class="col-md-6">
            <div>
                <div  class="d-flex align-items-center">
                    <div class="pr-3">
                           <a href="/profile/{{$liker->id}}"><img src="/storage/{{$liker->image ? $liker->image : 'profile/jnUIV75gXXB0KpaQ9lauyFe4uT2pjHQri7rZeII1.png'}}" class="rounded-circle w-100" style="max-width:40px"></a>
                     
                     </div>
                     <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$liker->id}} " style="text-decoration:none">
                            <span class="text-dark">{{$liker->username}}</span>
                            </a>
                           </div>
                    </div>
                </div>
                
                <p>
                     <span class="font-weight-bold">
                        <a href="/profile/{{$liker->id}} " style="text-decoration:none">
                            <span class="text-dark">{{$liker->username}}</span>
                        </a>
                     </span>
                     {{$liker->description}}
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




