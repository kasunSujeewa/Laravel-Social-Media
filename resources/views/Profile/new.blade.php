<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Find Friend
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div class="card-body">
         @foreach($user as $usr)
            @if($usr->id==Auth::user()->id || !empty($usr->friendRequests()->where('friend_id',Auth::user()->id)->first()) )
            @else
                <div class="d-flex justify-content-between" data-usrid="{{$usr->id}}">
                    <div class="mr-1">
                        <img class="m-2" src="{{Storage::url($usr->avatar)}}" alt=""width=30px height=30px style="border-radius: 50%;">
                    </div>
                    <div class="mr-1 align-self-center">
                        <h5 >{{$usr->name}}</h5>
                    </div> 
                    <div class="mr-1 align-self-center">
                        <a href="" class="addrequest" style="text-decoration:none">{{Auth::user()->friendRequests()->where('friend_id',$usr->id)->first() ? ' request send' : 'Add friend'}}</a>
                    </div> 
                </div>

        </div>
            @endif
        @endforeach

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
        @foreach($friend_rq as $rq)
        <div class="card card-footer bg-light"  >
            <div class="d-flex justify-content-between" data-usrid="{{$usr->id}}">
                <div class="mr-1">
                     <img class="m-2" src="{{Storage::url($usr->avatar)}}" alt=""width=30px height=30px style="border-radius: 50%;">
                </div>
                <div class="mr-1 align-self-center">
                    <h5 >{{$rq->user->name}}</h5>
                </div> 
                <div class="mr-1 align-self-center">
                    <a href="" class="addrequest" style="text-decoration:none">Confirm</a>
                </div> 
            </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
  