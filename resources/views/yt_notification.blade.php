@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Youtube Notifications') }}

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#exampleModal">
   <i class="fa fa-plus-square"></i> Create New
</button>


                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Youtube Notifications</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-group">
            <label for="name">Name : </label>
            <input type="text" name="name" id="name" class="form-control" value="" required="required" title="">
        </div>
        <div class="form-group">
            <label for="channel_id">channel id : </label>
            <input type="text" name="channel_id" id="channel_id" class="form-control" value="" required="required" title="">
        </div>
        <div class="form-group">
            <label for="description">description : </label>
            <input type="text" name="description" id="description" class="form-control" value="" required="required" title="">
        </div>
        <div class="form-group">
            <label for="template_post">template post : </label>
            <input type="text" name="template_post" id="template_post" class="form-control" value="" required="required" title="">
        </div>
        <div class="form-group">
            <label for="webhook_url">webhook_url : </label>
            <input type="text" name="webhook_url" id="webhook_url" class="form-control" value="" required="required" title="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save">Save changes</button>
      </div>
    </div>
  </div>
</div>




<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>name</th>
            <th>channel id</th>
            <th>description</th>
            <th>template post</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($yt_notification as $list)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->channel_id }}</td>
            <td>{{ $list->description }}</td>
            <td>{{ $list->template_post }}</td>

            <td>
                <i  data-bs-toggle="tooltip" data-bs-original-title="hapus"  class='fa fa-times delete' data-route-url="{{ route("yt_notification.delete") }}" data-id="{{ $list->id }}" style='cursor:pointer;' id='del{{ $list->id }}'></i>
                ||
                <i data-bs-toggle="tooltip" data-bs-original-title="kirim notif sekarang" class='fa fa-share send-last' data-route-url="{{ route("yt_notification.send_last") }}" data-id="{{ $list->id }}" style='cursor:pointer;' id='del{{ $list->id }}'></i>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>














                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


<script type="module">

                $('.send-last').click(function(){
                    var id = $(this).data('id');
                    var route_url =  $(this).data('route-url');


                    swal({
                        title : 'are you sure ?',
                        type  : 'warning',
                        closeOnCancel: true,
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm : true

                    }, function(isConfirm){
                        if(isConfirm){
                            $.ajax({
                                url : route_url,
                                data : {id : id, _token : '{!! csrf_token() !!}' },
                                type : 'post',
                                error: function(err){
                                    swal('error', 'oops, something went wrong!!', 'error');
                                },
                                success:function(ok){
                                    swal({
                                    title : "success!",
                                    text : "data telah terkirim!",
                                    type : "success"
                                    }, function(){
                                        window.location.reload();
                                    })
                                }
                            })
                        }
                    });


                });

                $('.delete').click(function(){
                    var id = $(this).data('id');
                    var route_url =  $(this).data('route-url');


                    swal({
                        title : 'are you sure ?',
                        type  : 'warning',
                        closeOnCancel: true,
                        showCancelButton: true,
                        closeOnConfirm: false,
                        showLoaderOnConfirm : true

                    }, function(isConfirm){
                        if(isConfirm){
                            $.ajax({
                                url : route_url,
                                data : {id : id, _token : '{!! csrf_token() !!}' },
                                type : 'post',
                                error: function(err){
                                    swal('error', 'oops, something went wrong!!', 'error');
                                },
                                success:function(ok){
                                    swal({
                                    title : "success!",
                                    text : "data telah terhapus!",
                                    type : "success"
                                    }, function(){
                                        window.location.reload();
                                    })
                                }
                            })
                        }
                    });


                });



$('.save').click(function(){
    var form_data = {
        name    : $('#name').val(),
        channel_id  : $('#channel_id').val(),
        description : $('#description').val(),
        template_post : $('#template_post').val(),
        webhook_url : $('#webhook_url').val(),
         _token : '{!! csrf_token() !!}'
    }

    $.ajax({
        url : '{{ route("yt_notification.insert") }}',
        data : form_data,
        type : 'post',
        error: function(err){
            swal('error', 'oops, something went wrong!!', 'error');
        },
        success:function(ok){
            swal({
            title : "success!",
            text : "data telah tersimpan!",
            type : "success"
            }, function(){
                window.location.reload();
            })
        }
    })
});


const tooltipTriggerList = document.querySelectorAll(
  '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
  (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

</script>

@endsection
