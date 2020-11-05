@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
<div class="col-6">
<div class="card gedf-card" style="margin-top: 0.97rem;" id="dataOne">
                    <div class="card-header">
                        
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="{{Storage::url($post->user->avatar)}}" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">{{ucfirst($post->user->name)}}</div>
                                    <div class="h7 text-muted">Miracles Lee Cross</div>
                                </div>
                                <hr>
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
                        </div>
                        @endif

                    </div>
                    <div class="card-body" >
                        <div class="text-muted h7 mb-2"> <i class="fa fa-clock-o"></i>{{ $post->created_at->diffForHumans() }}</div>
                        <a class="card-link" href="#">
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
                    </div>
                    @if(isset($comments))
                    @foreach($comments as $comment)
                    <ul class="media-list m-3" style="margin-left:-30px" >
                        <li class="media"style="border-bottom:1px dashed #efefef;margin-left:-30px" >
                            <a href="#" class="pull-left m-1S" style="padding-right:10spx">
                                <img style=" width:64px;height:64px;border:2px solid #e5e7e8;"
                                 src="{{Storage::url($comment->user->avatar)}}" alt="" class="rounded-circle">
                            </a>
                            <div class="media-body" data-comment_id="{{$comment->id}}">
                                <span class="text-muted pull-right">
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </span>
                                <strong class="text-success">{{ucfirst($comment->user->name)}}</strong>
                                <p>
                                    {{$comment->comment}}
                                    @if(Auth::user()->id==$comment->user->id)
                               <span class="badge badge-light"><a href="" class="delcom">Delete</a></span>
                               @endif
                                </p>
                                
                            </div>
                            </ul>
                    @endforeach
                    @endif
                    <form id="comment-form1">
        @csrf
        <input type="hidden" id="postId23" name="post_id" value="{{$post->id}}">
        <div class="form-group m-3">
            
            <input type="text" class="form-control rounded-pill p-3 shadow " id="comment13" aria-describedby="emailHelp" placeholder="comment here..." name="comment" required>
        
           
        </div>
        <div class="from-group m-3">
        <button type="submit" class="btn btn-sm btn-primary from-control rounded-pill float-right shadow mb-2">Add comment</button>
        </div>
        
        </form>
                </div>
                </div>
                </div>

@endsection