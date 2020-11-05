@extends('layouts.app')
@section('content')
<div class="timeline">
<div class="timeline-header">
<div class="row justify-content-center">
<div class="col-8">

<div class=" d-flex justify-content-start bg-dark text-white rounded-pill p-3 shadow ">
<img class="m-2" src="{{Storage::url(Auth::user()->avatar)}}" alt=""width=30px height=30px style="border-radius: 50%;">
<h5 class="p-1 align-self-center" style="margin-right:300px">{{ucfirst(Auth::user()->name)}}</h5>
<button class="btn btn-sm text-white" data-toggle="modal" data-target="#add_post"><i class="fa fa-share-alt-square" aria-hidden="true"></i> Share Your Own Post</button>



<hr>
</div>

@if(isset($posts))
@foreach($posts as $post)
<div class="card gedf-card" style="margin-top: 0.97rem;" id="dataOne">

                    <div class="card-header">




                            <div class="d-flex justify-content-start align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="{{Storage::url($post->user->avatar)}}" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><a href="/profile/{{$post->user->slug}}">{{ucfirst($post->user->name)}}</a></div>
                                    <div class="h7 text-muted">Miracles Lee Cross</div>
                                </div>

                            @if(Auth::user()==$post->user)
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">Configuration</div>
                                        <button data-toggle="modal" data-target="#Edit_post" data-postname='{{$post->postName}}' data-postdescription='{{$post->description}}' data-postid="{{$post->id}}" id="submit" class="dropdown-item" >Edit</button>
                                        <button class="dropdown-item" data-postid="{{$post->id}}" data-toggle="modal" data-target="#Delete_post">Delete</button>
                                        <a class="dropdown-item" href="#">Report</a>
                                    </div>
                                </div>
                            </div>

                        @endif

                    </div>
                    </div>

                    <div class="card-body" >
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{ $post->created_at->diffForHumans() }}</div>
                        <a class="card-link" href="/posts/{{$post->id}}">
                            <h5 class="card-title">{{ucfirst($post->postName)}}</h5>
                        </a>

                        <p class="card-text">
                            {{$post->description}}
                        </p>
                        <small class="m-1 text-muted"><i class="fa fa-thumbs-up" aria-hidden="true"></i>{{$post->likes->where('status',1)->count()}}</small>
                        <small class="m-1 text-muted"><i class="fa fa-thumbs-down" aria-hidden="true"></i>{{$post->likes->where('status',0)->count()}}</small>
                        <small class="m-1 text-muted"><i class="fa fa-commenting" aria-hidden="true"></i>{{$post->comments->count()}}</small>
                    </div>
                    <div class="card-footer" data-postid="{{$post->id}}">

                    <a href="#" class="badge badge-primary like" data-postid="{{$post->id}}">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ?
                     Auth::user()->likes()->where('post_id', $post->id)->first()->status == 1 ? 'Liked' : 'Like' : 'Like'  }}</a>

               <a href="#" class="badge badge-danger like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ?
                Auth::user()->likes()->where('post_id', $post->id)->first()->status == 0 ? 'Disliked' : 'Dislike' : 'Dislike'  }}</a>
                <button  class="btn btn-link comment ml-3 text-decoration-none" data-toggle="modal" data-target="#comment_modal" data-idone="{{$post->id}}" data-postname="{{$post->postName}}" data-postdescription="{{$post->description}}"><i class="fa fa-comment" aria-hidden="true"></i>Comments</button>
                    </div>

                </div>

                @endforeach





<div class="m-3">
{{ $posts->links() }}
</div>
@endif
</div>
<div class="col-2"  >
<div class="accordion" id="accordionExample" style="position:fixed">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Find Friend
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">






        <div class="card-body">
        @if(isset($user))
    @foreach($user as $usr)

            @if($usr->friends->where('friend_id',Auth::user()->id)->first() )

            @else
            @if($usr->friendRequestsSend->where('status',false)->where('friend_id',Auth::user()->id)->first())
            @else
                <div class="d-flex justify-content-between" data-usrid="{{$usr->id}}">
                    <div class="mr-1">
                        <img class="m-2" src="{{Storage::url($usr->avatar)}}" alt=""width=30px height=30px style="border-radius: 50%;">
                    </div>
                    <div class="mr-1 align-self-center">
                        <h5 >{{$usr->name}}</h5>
                    </div>
                    <div class="mr-1 align-self-center">
                        <a href="" class="addrequest" style="text-decoration:none">{{Auth::user()->friendRequestsSend()->where('friend_id',$usr->id)->first() ? ' request send' : 'Add friend'}}</a>
                    </div>
                </div>
                @endif
                @endif
         @endforeach
         @endif
        </div>


    </div>


    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Friend Requests
        </button>
      </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
        <div class="card-body">
        @if(isset($friend_rq))
        @foreach($friend_rq as $fr)

            <div class="d-flex justify-content-between" data-usrid="{{$fr->user->id}}">
                <div class="mr-1">
                     <img class="m-2" src="{{Storage::url($fr->user->avatar)}}" alt=""width=30px height=30px style="border-radius: 50%;">
                </div>
                <div class="mr-1 align-self-center">
                    <h5 >{{$fr->user->name}}</h5>
                </div>
                <div class="mr-1 align-self-center">
                    <a href="" class="confirm" style="text-decoration:none">Confirm</a>
                    <a href="" class="remove" style="text-decoration:none">Delete</a>
                </div>
            </div>
        </div>
        @endforeach
        @endif

    </div>
    </div>

    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Friends
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        @if(isset($friends))
        @foreach($friends as $fr)


        <div class="card card-footer bg-light"  >
            <div class="d-flex justify-content-between" data-usrid="{{$fr->user_id}}">
                <div class="mr-1">
                     <img class="m-2" src="{{Storage::url($fr->user->avatar)}}" alt=""width=30px height=30px style="border-radius: 50%;">
                </div>
                <div class="mr-1 align-self-center">
                    <h5 >{{$fr->user->name}}</h5>
                </div>
                <div class="mr-1 align-self-center">
                    <a href="" class="removefr" style="text-decoration:none">remove</a>

                </div>
            </div>
        </div>


        @endforeach
        @endif
      </div>
  </div>
</div>


@endsection
