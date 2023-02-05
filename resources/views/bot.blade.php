@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Filter Bots') }}

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
        <h1 class="modal-title fs-5" id="exampleModalLabel">Filter Bot</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div class="form-group">
            <label for="bot_name">Bot Name : </label>
            <input type="text" name="bot_name" id="bot_name" class="form-control" value="" required="required" title="">
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
            <th>Bot name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bots as $list)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $list->bot_name }}</td>
            <td>
                <i class='fa fa-times delete' data-route-url="{{ route("bot.delete") }}" data-id="{{ $list->id }}" style='cursor:pointer;' id='del{{ $list->id }}'></i>
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
        bot_name : $('#bot_name').val(),
         _token : '{!! csrf_token() !!}'
    }

    $.ajax({
        url : '{{ route("bot.insert") }}',
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


</script>


@endsection
