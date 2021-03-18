@extends('layouts.app')

@section('content')
<div class="container loccini">
    <div class="row">
        <div class="col-md-6  offset-3 mb-3" id="result">
           
        </div>
    </div>
    @if(count($posts)>0)
    @foreach ($posts as $key => $post)

           <div class="row">
                <div class="col-md-6  offset-3">
                  
                <div class="card">
                      <div class="card-header name-tag">
                          <a href="/profile/{{$post->user->id}} " style="text-decoration:none">
                        <span class="text-dark font-weight-bold">{{$post->user->username}}</span></a>
                      </div>
                      <div class="card-body ">
                         <a href="/p/show/{{$post->id}} "> <img src="{{$post->getFirstMediaUrl()}}" class="w-100" style="max-width: 370px"></a>   

                
                      </div>
                      <hr>
                      <div style="padding-left: 20px;">
                      <p>
                                <span class="font-weight-bold">
                                    <a href="/profile/{{$post->user->id}} " style="text-decoration:none">
                                        <span class="text-dark">{{$post->user->username}}</span>
                                    </a>
                                </span>
                                {{$post->caption}}<br>
                                    


                    <div class="d-flex">
                      <div class="comment">
                             <a href="javascript:void(0)" onclick="likeIt({{$post->id}},this)" 
                                        style="{{  $post->getStatus($post->id) ? 'color: red' : 'color:black' }}" id='like{{$post->id}}'>
                                        <i class="fa fa-heart">
                                        </i> </a>  
                                            @if($post->getLikes($post->id)==0)
                                              
                                            @elseif($post->getLikes($post->id)==1)
                                               <span id="likess">{{$post->getLikes($post->id)}}<a href="/likers/{{$post->id}}" style="color:black"class="font-weight-bold"> like</a>    </span> 
                                            @else

                                                <span id="likess">{{$post->getLikes($post->id)}}<a href="/likers/{{$post->id}}" style="color:black"class="font-weight-bold"> likes</a>  </span>                                         
                                            @endif
                      </div>

                      <div>
                            
                                    <div class="comment">
                                        <a href="/p/show/{{$post->id}}" style="color:black"  ><i class="fa fa-comment ml-4">
                                        </i></a>
                                       <span id="NoOfComments">{{$post->getComments($post->id) ? $post->getComments($post->id) : '0'}}</span>
                                    </div>

                      </div>

                    </div>


                    

                            </p>
                        </div>

                </div>
            </div>
            </div>
            
            <div class="row pt-2 pb-4">
                <div class="col-md-6 offset-3">
                    <div>
                          
               
                    </div>
                </div>
            </div>
    
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$posts->links()}}
        </div>
    </div>

    @else
        
        <h1 class="font-weight-bold h1">Welcome</h1>
        <div  class="font-weight-bold username">{{Auth::user()->name}}</div>
            <div class="row main-row">
                <div class="col-md-6">
                    <div class="mt-5">
                        <p class="para">
                            <span class="font-weight-bold">
                                <span class="text-dark">AfroCodeGram</span>
                            </span>
                            Welcomes you to a community of makers and friendly folks sharing and discovering latest in tech.
                        </p>
                           <div class="para1">Curious what's trending today? head over to your  <a href="/profile/{{Auth::user()->id}}" style="text-decoration:none">profile</a> and upload products,designs that are fascinating and also enter name into the search field to follow new friends and see thier posts.<br>
                            Remember, everything you post is saved to your profile and can easily find it again. You can also explore topics, ask the<br>
                            community for reccomendations. once again welcome on board
                         <div class="font-weight-bold">Kindly follow us <strong><a href="/profile/1" style="text-decoration:none">@AfroCodeGram</a></strong></div></div>
                    </div>
                </div>
                <div class="col-md-6 col2">
                <img src="/images/intro2.jpg" class="w-100" class="img2">
            </div>
        </div>
    @endif

 
</div>
@endsection
