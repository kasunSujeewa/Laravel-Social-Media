@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-family: 'Tenali Ramakrishna', sans-serif;"><img src="{{Storage::url($user->avatar)}}" width='70px' height='70px' alt="kasun" style="border-radius: 50%;" >  {{ ucfirst($user->name)}}</h1>

@if(Auth::check())
@if((Auth::user()==$user))
<button data-toggle="modal" data-target="#Update_details" class="btn btn-link" data-userid="{{$user->profile->user_id}}" data-department="{{$user->profile->department}}" data-dob="{{$user->profile->dob}}" data-school="{{$user->profile->school}}" data-faculty="{{$user->profile->faculty}}" data-about="{{$user->profile->about}}">Update Your Details</button>
@else

@endif 
@endif
@if(isset($profile))
    <ul class="list-group" style="max-width:250px;font-family: 'Electrolize', sans-serif;" >
    
        <li ><span class="font-weight-bold">High School :</span>{{$profile->school}}</li>
        <li ><span class="font-weight-bold">Birthday :</span>{{$profile->dob}}</li>
        <li ><span class="font-weight-bold">Faculty :</span>{{$profile->faculty}}</li>
        <li ><span class="font-weight-bold">Department :</span>{{$profile->department}}</li>
        <li ><span class="font-weight-bold">About :</span>{{$profile->about}}</li>
    </ul>
    
    @endif
    <div class="timeline">
    @if(Auth::user()==$profile->user)
<div class="timeline-header">
<div class="row justify-content-center">
<div class="col-8">

<div class=" d-flex  shadow  rounded bg-dark rounded-pill p-3 ">

<button class="btn btn-sm text-white " data-toggle="modal" data-target="#add_post"><i class="fa fa-share-alt-square" aria-hidden="true"></i> Share Your Own Post</button>



<hr>
</div>
@endif

@if(isset($posts))
@foreach($posts as $post)
<div class="card gedf-card" style="margin-top: 0.97rem;" id="dataOne">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" src="{{Storage::url($post->user->avatar)}}" alt="">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0">{{ucfirst($post->user->name)}}</div>
                                    <div class="h7 text-muted">Miracles Lee Cross</div>
                                </div>
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
                    </div>
                    <div class="card-footer" data-postid="{{$post->id}}">
                    
                    <a href="#" class="badge badge-primary like" data-postid="{{$post->id}}">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ?
                     Auth::user()->likes()->where('post_id', $post->id)->first()->status == 1 ? 'Liked' : 'Like' : 'Like'  }}</a>
                     
               <a href="#" class="badge badge-danger like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ?
                Auth::user()->likes()->where('post_id', $post->id)->first()->status == 0 ? 'Disliked' : 'Dislike' : 'Dislike'  }}</a>
                    </div>
                </div>

@endforeach
<div class="m-3">
{{ $posts->links() }}
</div>
@endif


</div>


</div>
</div>
</div>
</div>
    <!-- modal for Update details-->
<div class="modal fade" id="Update_details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Your Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="Update-detail-form">
        @csrf
        <input type="hidden" id="user_id">
        <div class="form-group">
            <label for="exampleInputEmail1">High School</label>
            <input type="text" class="form-control" id="school" aria-describedby="emailHelp" placeholder="" name="school" required>
           
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Date of birth</label>
            <input type="date" class="form-control" id="dob" aria-describedby="emailHelp" placeholder="" name="dob" required>
           
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Faculty</label>
            <select name="faculty" id="faculty">
                <option value="Applied">Applied</option>
                <option value="Management">Management</option>
                <option value="Geo">Geo</option>
                <option value="Social">Social</option>
                <option value="Agriculture">Agriculture</option>
            </select>
           
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Department</label>
            <input type="text" class="form-control" id="department" aria-describedby="emailHelp" placeholder="" name="department" required>
           
        </div>
        
        <div class="form-group">
            <label for="exampleFormControlTextarea1">About</label>
            <textarea class="form-control" name="about" id="about" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Updates</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
@endsection