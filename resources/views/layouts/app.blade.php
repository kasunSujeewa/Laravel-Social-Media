<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SUSL Social</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <style>
   .navbar{
       background-color:#1B98E0;
   }
   .thumbnail {
    padding:0px;
}
.panel {
	position:relative;
}
   .panel>.panel-heading:after,.panel>.panel-heading:before{
	position:absolute;
	top:11px;left:-16px;
	right:100%;
	width:0;
	height:0;
	display:block;
	content:" ";
	border-color:transparent;
	border-style:solid solid outset;
	pointer-events:none;
}
.panel>.panel-heading:after{
	border-width:7px;
	border-right-color:#f7f7f7;
	margin-top:1px;
	margin-left:2px;
}
.panel>.panel-heading:before{
	border-right-color:#ddd;
	border-width:8px;
}


   </style>
   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-secondary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    SUSL
                </a>
                @guest
                @else
                <a class="navbar-brand" href="/profile/{{Auth::user()->slug}}">
                    Profile
                </a>
                @endguest
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            Notifications <i class="fa fa-bell-o" aria-hidden="true"></i><span class="badge badge-danger">{{Auth ::user()->unreadNotifications->count()}}</span> <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                               @if(empty(Auth ::user()->unreadNotifications->count()))
                               <span>You haven't Notfications</span>
                               @else
                               @foreach (Auth::user()->unreadNotifications as $item)
                                   <ul class="dropdown-item">
                                   <li class="noty m-0 bg-warning"><a href="/posts/{{$item->data['post_id']}}">{{$item->data['body']}}</a></li>

                                   </ul>
                               @endforeach
                               @endif
                            </div>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- modal for post -->
<div class="modal fade" id="add_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Your Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="post-form">
        @csrf
        <div class="form-group">
            <label for="exampleInputEmail1">Post Name</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="" name="postName" required>

        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Post</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<!-- Edit model -->
<div class="modal fade" id="Edit_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Your Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  id="product-update-form">
        @csrf
        @method('PATCH')
        <input type="hidden" id="postid">
        <div class="form-group">
            <label for="exampleInputEmail1">Post Name</label>
            <input type="text" class="form-control" id="postName1"   name="postName" required>

        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea class="form-control" name="description" id="postDescription" rows="3" required></textarea>
        </div>
        <button type="submit"  class="btn btn-primary">Save Changes</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
<!-- modal for delete -->
<div class="modal fade" id="Delete_post" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Do You Really want to delete this post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form id="product-delete-form">
        @csrf


       <input type="hidden" id="postid1">
        <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
 <!-- comment modal -->
 <div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Your Comment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="card">
      <div class="card-header">
      <input type="text" readonly class="form-control-plaintext font-weight-bold" id="post_name" >
      </div>
      <div class="card-body">
      <input type="text" readonly class="form-control-plaintext font-weight-light" id="post_description" >
      </div>
      </div>
      <form id="comment-form">
        @csrf
        <input type="hidden" id="postId3" name="post_id">
        <div class="form-group">
            <label for="exampleInputEmail1">Comment</label>
            <input type="text" class="form-control" id="comment1" aria-describedby="emailHelp" placeholder="comment here..." name="comment" required>

        </div>

        <button type="submit" class="btn btn-sm btn-primary">Add comment</button>
        </form>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script >
    // edit post
    $(document).ready(function () {
    $('#Edit_post').on('show.bs.modal', function (event) {



  var button = $(event.relatedTarget) // Button that triggered the modal
  var title = button.data('postname') // Extract info from data-* attributes
  var description = button.data('postdescription') // Extract info from data-* attributes
  var id = button.data('postid') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

  var modal = $(this)

  modal.find('.modal-body #postName1').val(title);
  modal.find('.modal-body #postDescription').val(description);
  modal.find('.modal-body #postid').val(id);
//   var submitUrl = '/posts/' + id,
//   form = $('#product-update-form');
//   form.attr('action', submitUrl);





    });

    $('#product-update-form').on('submit', function(e){
        e.preventDefault();
     var id= $('#postid').val();

     $.ajax({
         type:"PATCH",
         url:"/posts/"+id,
         data: $('#product-update-form').serialize(),
         success: function(response){
             console.log(response);
             $('#Edit_post').modal('hide');
             swal("Updated..!", "Its Done", "success");
             location.reload();

         },
         error:function(error){
             console.log(error);
         }
     });
    });
    // Delete post
    $('#Delete_post').on('show.bs.modal', function (event){

        var button = $(event.relatedTarget) // Button that triggered the modal
  var idnew = button.data('postid')

  var modal = $(this)

  modal.find('.modal-body #postid1').val(idnew);
    });
  $('#product-delete-form').on('submit', function(e){
        e.preventDefault();
     var id= $('#postid1').val();
     console.log(id);



     $.ajax({
         type:"DELETE",
         url:"/posts/" + id,
         data:$('#product-delete-form').serialize(),

         success: function(response){
             console.log(response);
             $('#Delete_post').modal('hide');
             swal("Deleted..!", "Its Done", "success");
             location.reload();


         },
         error:function(error){
             console.log(error);

         }

    });
    });
    //posting
    $('#post-form').on('submit', function(e){
        e.preventDefault();


     $.ajax({
         type:"POST",
         url:"/posts",
         data: $('#post-form').serialize(),
         success: function(response){
             console.log(response);
             $('#add_post').modal('hide');
             swal("Post Created..!", "Its Done", "success");
             location.reload();

         },
         error:function(error){
             console.log(error);
         }
     });
    });
    //profile_update
    $('#Update_details').on('show.bs.modal', function (event) {


        console.log('its work');
    var button = $(event.relatedTarget) // Button that triggered the modal
    var id = button.data('userid') // Extract info from data-* attributes
    var faculty = button.data('faculty') // Extract info from data-* attributes
    var dob = button.data('dob') // Extract info from data-* attributes
    var department = button.data('department') // Extract info from data-* attributes
    var about = button.data('about') // Extract info from data-* attributes
    var school = button.data('school') // Extract info from data-* attributes


     var modal = $(this)

    modal.find('.modal-body #faculty').val(faculty);
    modal.find('.modal-body #about').val(about);
    modal.find('.modal-body #dob').val(dob);
    modal.find('.modal-body #department').val(department);
    modal.find('.modal-body #school').val(school);
    modal.find('.modal-body #user_id').val(id);
  //   var submitUrl = '/posts/' + id,
  //   form = $('#product-update-form');
  //   form.attr('action', submitUrl);





      });

      $('#Update-detail-form').on('submit', function(e){
          e.preventDefault();
       var id= $('#user_id').val();

       $.ajax({
           type:"POST",
           url:"/profile/"+id,
           data: $('#Update-detail-form').serialize(),
           success: function(response){
               console.log(response);
               $('#Update_details').modal('hide');
               swal("Updated..!", "Its Done", "success");
               location.reload();

           },
           error:function(error){
               console.log(error);
           }
       });
      });
      var postId = 0;
$('.like').on('click', function(event) {
    event.preventDefault();
    postId = event.target.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;

    $.ajax({
        method: 'POST',
        url: '/like',
        data: {isLike: isLike, postId: postId, "_token": "{{ csrf_token() }}"}
    })
        .done(function() {
            event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'Liked' : 'Like' : event.target.innerText == 'Dislike' ? 'Disliked' : 'Dislike';
            if (isLike) {
                event.target.nextElementSibling.innerText = 'Dislike';
            } else {
                event.target.previousElementSibling.innerText = 'Like';

            }
            location.reload();

        });
});
$('#comment_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
  var postId = button.data('idone')
  var postName= button.data('postname')
  var postDescription= button.data('postdescription')

    var modal = $(this)
    modal.find('.modal-body #postId3').val(postId);
    modal.find('.modal-body #post_name').val(postName);
    modal.find('.modal-body #post_description').val(postDescription);

});
$('#comment-form').on('submit', function(e){
          e.preventDefault();



       $.ajax({
           type:"POST",
           url:"/comment",
           data:$('#comment-form').serialize(),
           success: function(response){

               $('#comment_model').modal('hide');

               location.reload();

           },
           error:function(error){
               console.log(error);
           }
       });
      });
      $('#comment-form1').on('submit', function(e){
          e.preventDefault();



       $.ajax({
           type:"POST",
           url:"/comment",
           data:$('#comment-form1').serialize(),
           success: function(response){
               location.reload();
               },
           error:function(error){
               console.log(error);
           }
       });
      });
$('.addrequest').on('click',function(event){
    event.preventDefault();

    var frdid= event.target.parentNode.parentNode.dataset['usrid'];
  var class1=event.target.classList[0];
  if(event.target.innerHTML=="Add friend"){
   $.ajax({
     type:"POST",
     url:'/friendrq',
     data:{friend_id: frdid, "_token": "{{ csrf_token() }}"},
     success: function(response){
               console.log('done');
               },
           error:function(error){
               console.log(error);
           }
   }).done(function(){
    event.target.innerHTML="Add friend" ? 'request send' : 'Add friend';




   })
  }
  else{
    $.ajax({
     type:"Delete",
     url:'/delfriendrq',
     data:{friend_id: frdid, "_token": "{{ csrf_token() }}"},
     success: function(response){
               console.log('done 1');
               },
           error:function(error){
               console.log(error);
           }
   }).done(function(){
     event.target.innerHTML="request send" ? 'Add friend' : 'request send';




   })

  }

});
$('.confirm').on('click',function(e){
  e.preventDefault();
  var friend_id=e.target.parentElement.parentElement.dataset.usrid;

  $.ajax({
    type:"POST",
    url:"/confirmRq",
    data:{friend_id:friend_id, "_token": "{{ csrf_token() }}"},
    success:function(response){
      location.reload();
    },
    error:function(error){
               console.log(error);
           }

  })
});
$('.remove').on('click',function(e){
  e.preventDefault();
  var friend_id=e.target.parentElement.parentElement.dataset.usrid;

  $.ajax({
    type:"POST",
    url:"/deleteRq",
    data:{friend_id:friend_id, "_token": "{{ csrf_token() }}"},
    success:function(response){
      location.reload();
    },
    error:function(error){
               console.log(error);
           }

  })
});
$('.removefr').on('click',function(e){
  e.preventDefault();
  var friend_id=e.target.parentElement.parentElement.dataset.usrid;


  $.ajax({
    type:"POST",
    url:"/deletefr",
    data:{friend_id:friend_id, "_token": "{{ csrf_token() }}"},
    success:function(response){
      console.log('removed');
      location.reload();
    },
    error:function(error){
               console.log(error);
           }

  })
});
$('.delcom').on('click',function(e){
  e.preventDefault();
  var comment_id=e.target.parentElement.parentElement.parentElement.dataset.comment_id;


  $.ajax({
    type:"POST",
    url:"/deletecom",
    data:{comment_id:comment_id, "_token": "{{ csrf_token() }}"},
    success:function(response){
      console.log("deleted");
      location.reload();
    },
    error:function(error){
               console.log(error);
           }

  })
});







});
window.Echo.private('App.User.' + this.userId)
    .notification((notification) => {
        console.log(notification);
    });









    </script>



</body>
</html>
