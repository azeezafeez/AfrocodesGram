@extends('layouts.app')

@section('content')
<div class="container">
     <div class="col-md-6  offset-3 mb-3" id="result">
           
     </div>
    <div class="row">
        <div class="col-md-8">
            <img src="/storage/{{$post->image}}" class="w-100">        
        </div>

        <div class="col-md-4">
            <div>
                <div  class="d-flex align-items-center show">
                    <div class="pr-3">
                         <img src="/storage/{{$image}}" class="rounded-circle w-100" style="max-width:40px">
                    </div>
                    <div>
                  
                        <div class="font-weight-bold">
                            <a href="/profile/{{$post->user->id}} " style="text-decoration:none">
                            <span class="text-dark">{{$post->user->username}}</span></a>
                            
                        </div>
                    </div>
                </div>
                <hr>
                <span class="font-weight-bold">
                    <a href="/profile/{{$post->user->id}} " style="text-decoration:none">
                        <span class="text-dark">{{$post->user->username}}</span>
                    </a>
                </span>
                {{$post->caption}}
                

                               



                <div class="mt-5">
                    <span class="font-weight-bold">Comments</span>
                </div>
                <hr>
                <div>
                    <div id="commentSpace">
                    
                        @if (count($comments)>0)
                        @foreach ($comments as $comment)
                            <p>
                              <a href="/profile/{{$post->id}}" style="text-decoration:none">
                                 <img src="/storage/{{$comment->image ? $comment->image : 'profile/jnUIV75gXXB0KpaQ9lauyFe4uT2pjHQri7rZeII1.png' }}" class="rounded-circle w-100" style="max-width:40px">
                              </a>
                            <span class="font-weight-bold "  id="username">
                                <a href="/profile/{{$post->user->id}} " style="text-decoration:none"  class="ml-3">
                                    <span class="text-dark">{{$comment->username}}</span>
                                </a>
                            </span>
                               <span style="width:30px"> {{$comment->comment}}</span><br>

                               <span class="text-muted "><div class="mt-2">{{$comment->time}}</div></span>
                            </p>
                                        
                        @endforeach
                    @else
                        <p><span class="font-weight-bold">No Comments!</span></p>
                    @endif
                    </div>
                    <hr> 
                    
                    
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
                                        <span id="NoOfComments">{{$commentCount ? $commentCount: ''}}</span>
                                    </div>

                      </div>

                    </div>


                    
                        
                    <hr>
                     <textarea class="form-control mt-4 text" id="textarea" placeholder='enter comment'></textarea>
                     <button class="btn btn-success btn-sm badge mt-2 post" style="margin-left:320px" id="postComment" onclick="comment({{$post->id}})">Post</button>
                </div>
                
            </div>
        </div>
    </div>
    
</div>
@endsection
